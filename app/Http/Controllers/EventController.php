<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\Multimedia;
use App\Models\Page;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('started_at', 'desc')->paginate(20);
        return view('events.index')->with('events', $events);
    }

    public function create()
    {
        $event = new Event([
            'started_at' => Carbon::now(),
            'ended_at' => Carbon::now(),
        ]);
        return view('events.edit')->with('event', $event);
    }

    public function store(EventRequest $request)
    {
        $event = Event::create($request->allValidated());
        if( $request->hasFile('media') ) Multimedia::build($request, $event);
        return redirect()->route('events.show', $event);
    }

    public function show(Event $event)
    {
        return view('events.show')->with('event', $event);
    }

    public function edit(Event $event)
    {
        return view('events.edit')->with('event', $event);
    }

    public function update(EventRequest $request, Event $event)
    {
        // Update event
        $event->fill($request->allValidated())->save();

        // Modify media
        if( $request->hasFile('media') && $event->multimedia ) {
            $event->multimedia->upload($request);
        } elseif( $request->hasFile('media') ) {
            Multimedia::build($request, $event);
        } elseif( $request->has('remove_media') ) {
            $event->multimedia->delete();
        }

        return redirect()->route('events.show', $event);
    }

    public function remove(Event $event)
    {
        return view('events.remove')->with('event', $event);
    }

    public function destroy(Event $event)
    {
        $event->multimedia()->delete();
        $event->forceDelete();
        return redirect()->route('events.index');
    }

    public function createBlock(Event $event)
    {
        if( is_null($event->page) ) {
            $page = Page::create([
                'title' => $event->title,
                'slug' => 'event_'. $event->id,
                'order' => 1,
                'type' => 'event',
            ]);
            $page->event()->save($event);
            $event->refresh();
        }

        return redirect()->route('pages.blocks.create', $event->page);
    }

    public function tagging(Request $request, Event $event)
    {
        $request->validate(['tag_id' => 'required|exists:tags,id']);
        if( $request->method() == 'POST' ) $event->tags()->attach($request->tag_id);
        elseif( $request->method() == 'DELETE' ) $event->tags()->detach($request->tag_id);
        return redirect()->route('events.show', $event);
    }
}
