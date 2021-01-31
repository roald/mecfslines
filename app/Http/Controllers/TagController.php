<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::orderBy('name', 'asc')->get();
        return view('tags.index')->with('tags', $tags);
    }

    public function create()
    {
        $tag = new Tag();
        return view('tags.edit')->with('tag', $tag);
    }

    public function store(TagRequest $request)
    {
        $tag = Tag::create($request->allValidated());
        return redirect()->route('tags.show', $tag);
    }

    public function show(Tag $tag)
    {
        return view('tags.show')->with('tag', $tag);
    }

    public function edit(Tag $tag)
    {
        return view('tags.edit')->with('tag', $tag);
    }

    public function update(TagRequest $request, Tag $tag)
    {
        $tag->fill($request->allValidated())->save();
        return redirect()->route('tags.show', $tag);
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index');
    }
}
