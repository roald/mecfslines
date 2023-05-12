<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PersonRequest;
use App\Models\Multimedia;
use App\Models\Page;
use App\Models\Person;

class PersonController extends Controller
{
    public function index()
    {
        $people = Person::orderBy('order', 'asc')->paginate(20);
        return view('people.index')->with('people', $people);
    }

    public function create()
    {
        $person = new Person();
        return view('people.edit')->with('person', $person);
    }

    public function store(PersonRequest $request)
    {
        $person = Person::create($request->allValidated());
        if( $request->hasFile('media') ) Multimedia::build($request, $person);
        return redirect()->route('people.show', $person);
    }

    public function show(Person $person)
    {
        return view('people.show')->with('person', $person);
    }

    public function edit(Person $person)
    {
        return view('people.edit')->with('person', $person);
    }

    public function update(PersonRequest $request, Person $person)
    {
        // Update person
        $person->fill($request->allValidated())->save();

        // Modify media
        if( $request->hasFile('media') && $person->multimedia ) {
            $person->multimedia->upload($request);
        } elseif( $request->hasFile('media') ) {
            Multimedia::build($request, $person);
        } elseif( $request->has('remove_media') ) {
            $person->multimedia->delete();
        }

        return redirect()->route('people.show', $person);
    }

    public function remove(Person $person)
    {
        return view('people.remove')->with('person', $person);
    }

    public function destroy(Person $person)
    {
        $person->multimedia()->delete();
        $person->delete();
        return redirect()->route('people.index');
    }

    public function createBlock(Person $person)
    {
        if( is_null($person->page) ) {
            $page = Page::create([
                'title' => $person->name,
                'slug' => 'person_'. $person->id,
                'order' => 1,
                'type' => 'person',
            ]);
            $page->person()->save($person);
            $person->refresh();
        }

        return redirect()->route('pages.blocks.create', $person->page);
    }

    public function tagging(Request $request, Person $person)
    {
        $request->validate(['tag_id' => 'required|exists:tags,id']);
        if( $request->method() == 'POST' ) $person->tags()->attach($request->tag_id);
        elseif( $request->method() == 'DELETE' ) $person->tags()->detach($request->tag_id);
        return redirect()->route('people.show', $person);
    }
}
