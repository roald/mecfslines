<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActionRequest;
use App\Models\Action;
use App\Models\Block;
use App\Models\Page;

class ActionController extends Controller
{
    public function index(Block $block)
    {
        return redirect()->route('blocks.show', $block);
    }

    public function create(Block $block)
    {
        $action = new Action([
            'block' => $block,
            'order' => $block->actions()->max('order') + 1,
        ]);
        $pages = Page::whereIn('type', ['page', 'redirect'])->orderBy('title', 'asc')->get();
        return view('actions.edit')->with('action', $action)->with('pages', $pages);
    }

    public function store(ActionRequest $request, Block $block)
    {
        $action = new Action($request->allValidated());
        $block->actions()->save($action);
        return redirect()->route('actions.show', $action);
    }

    public function show(Action $action)
    {
        return redirect()->route('blocks.show', $action->block);
    }

    public function edit(Action $action)
    {
        $pages = Page::whereIn('type', ['page', 'redirect'])->orderBy('title', 'asc')->get();
        return view('actions.edit')->with('action', $action)->with('pages', $pages);
    }

    public function update(ActionRequest $request, Action $action)
    {
        $action->fill($request->allValidated())->save();
        return redirect()->route('actions.show', $action);
    }

    public function destroy(Action $action)
    {
        $block = $action->block;
        $action->delete();
        return redirect()->route('blocks.show', $block);
    }
}
