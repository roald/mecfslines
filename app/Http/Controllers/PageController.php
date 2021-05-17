<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PageRequest;
use App\Models\Multimedia;
use App\Models\Page;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::whereIn('type', ['page', 'redirect'])->orderBy('order', 'asc')->paginate(20);
        return view('pages.index')->with('pages', $pages);
    }

    public function create(Request $request)
    {
        $page = new Page([
            'title' => '',
            'order' => Page::max('order') + 1,
            'type' => $request->has('redirect') ? 'redirect' : 'page',
        ]);
        return $this->edit($page);
    }

    public function store(PageRequest $request)
    {
        $pageValues = $request->allValidated();
        $pageValues['type'] = $request->page_type;
        $page = Page::create($pageValues);
        if( $request->hasFile('media') ) Multimedia::build($request, $page);
        if( $page->type == 'redirect' ) $this->saveRedirect($request, $page);
        return redirect()->route('pages.show', $page);
    }

    public function show(Page $page)
    {
        if( $page->type == 'event' ) return redirect()->route('events.show', $page->event);
        elseif( $page->type == 'project' ) return redirect()->route('projects.show', $page->project);

        return view('pages.show')->with('page', $page);
    }

    public function edit(Page $page)
    {
        if( $page->type == 'redirect' ) return $this->redirect($page);
        return view('pages.edit')->with('page', $page);
    }

    public function update(PageRequest $request, Page $page)
    {
        // Update page
        $page->fill($request->allValidated())->save();

        // Modify media
        if( $request->hasFile('media') && $page->multimedia ) {
            $page->multimedia->upload($request);
        } elseif( $request->hasFile('media') ) {
            Multimedia::build($request, $page);
        } elseif( $request->has('remove_media') ) {
            $page->multimedia->delete();
        }

        // Redirect updates
        if( $page->type == 'redirect' ) $this->saveRedirect($request, $page);

        return redirect()->route('pages.show', $page);
    }

    public function remove(Page $page)
    {
        return view('pages.remove')->with('page', $page);
    }

    public function destroy(Page $page)
    {
        $page->multimedia()->delete();
        $page->forceDelete();
        return redirect()->route('pages.index');
    }

    private function redirect(Page $page)
    {
        if( !env('TALC_REDIRECTS', false) ) return redirect()->route('pages.index');
        $pages = Page::where('type', 'page')->where('id', '!=', $page->id)->orderBy('title', 'asc')->get();
        return view('pages.redirect')->with('page', $page)->with('pages', $pages);
    }

    private function saveRedirect(PageRequest $request, Page $page)
    {
        $block = $page->blocks()->first();
        if( is_null($block) ) {
            $block = $page->blocks()->create([
                'type' => 'redirect',
                'order' => 1,
                'heading' => $page->title,
                'grant' => 'all',
            ]);
        }

        $action = $block->actions()->first();
        if( $action ) {
            $action->fill($request->get('redirect'))->save();
        } else {
            $values = $request->redirect;
            $values['action'] = __('Redirect');
            $values['order'] = 1;
            $block->actions()->create($values);
        }
    }
}
