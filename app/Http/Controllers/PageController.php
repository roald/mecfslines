<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageRequest;
use App\Models\Page;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('order', 'asc')->get();
        return view('pages.index')->with('pages', $pages);
    }

    public function create()
    {
        $page = new Page([
            'order' => Page::max('order') + 1,
        ]);
        return view('pages.edit')->with('page', $page);
    }

    public function store(PageRequest $request)
    {
        $page = Page::create($request->allValidated());
        return redirect()->route('pages.show', $page);
    }

    public function show(Page $page)
    {
        return view('pages.show')->with('page', $page);
    }

    public function edit(Page $page)
    {
        return view('pages.edit')->with('page', $page);
    }

    public function update(PageRequest $request, Page $page)
    {
        $page->fill($request->allValidated())->save();
        return redirect()->route('pages.show', $page);
    }

    public function remove(Page $page)
    {
        return view('pages.remove')->with('page', $page);
    }

    public function destroy(Page $page)
    {
        $page->forceDelete();
        return redirect()->route('pages.index');
    }
}
