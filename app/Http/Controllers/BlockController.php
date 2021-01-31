<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlockRequest;
use App\Models\Block;
use App\Models\Page;

class BlockController extends Controller
{
    public function index(Page $page)
    {
        return redirect()->route('pages.show', $page);
    }

    public function create(Page $page)
    {
        $block = new Block([
            'page' => $page,
            'order' => $page->blocks()->max('order') + 1,
        ]);
        return view('blocks.edit')->with('block', $block);
    }

    public function store(BlockRequest $request, Page $page)
    {
        $block = new Block($request->allValidated());
        $page->blocks()->save($block);
        return redirect()->route('blocks.show', $block);
    }

    public function show(Block $block)
    {
        return view('blocks.show')->with('block', $block);
    }

    public function edit(Block $block)
    {
        return view('blocks.edit')->with('block', $block);
    }

    public function update(BlockRequest $request, Block $block)
    {
        $block->fill($request->allValidated())->save();
        return redirect()->route('blocks.show', $block);
    }

    public function remove(Block $block)
    {
        return view('blocks.remove')->with('block', $block);
    }

    public function destroy(Block $block)
    {
        $page = $block->page;
        $block->delete();
        return redirect()->route('pages.blocks.index', $page);
    }
}
