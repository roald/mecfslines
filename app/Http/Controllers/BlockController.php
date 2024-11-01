<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BlockRequest;
use App\Http\Requests\MultimediaEmbedRequest;
use App\Http\Requests\MultimediaStoreRequest;
use App\Models\Block;
use App\Models\Multimedia;
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
        $block->load(['multimedia' => function ($query) {
            $query->orderBy('order', 'asc');
        }]);
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
        $block->actions()->delete();
        $block->multimedia()->delete();
        $block->delete();
        return redirect()->route('pages.blocks.index', $page);
    }

    public function tagging(Request $request, Block $block)
    {
        $request->validate(['tag_id' => 'required|exists:tags,id']);
        if( $request->method() == 'POST' ) $block->tags()->attach($request->tag_id);
        elseif( $request->method() == 'DELETE' ) $block->tags()->detach($request->tag_id);
        return redirect()->route('blocks.show', $block);
    }

    public function upload(MultimediaStoreRequest $request, Block $block)
    {
        Multimedia::build($request, $block);
        return redirect()->route('blocks.show', $block);
    }

    public function embed(MultimediaEmbedRequest $request, Block $block)
    {
        Multimedia::embed($request, $block);
        return redirect()->route('blocks.show', $block);
    }
}
