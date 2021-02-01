<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\Page;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('started_at', 'desc')->get();
        return view('events.index')->with('events', $events);
    }

    public function create()
    {
        $event = new Event();
        return view('events.edit')->with('event', $event);
    }

    public function store(EventRequest $request)
    {
        $event = Event::create($request->allValidated());
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
        $event->fill($request->allValidated())->save();
        return redirect()->route('events.show', $event);
    }

    public function remove(Event $event)
    {
        return view('events.remove')->with('event', $event);
    }

    public function destroy(Event $event)
    {
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
}
