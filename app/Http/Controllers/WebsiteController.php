<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\Page;
use App\Models\Product;
use App\Models\Tag;
use Auth;

class WebsiteController extends Controller
{
    public function homepage()
    {
        $page = Page::withCount('blocks')->orderBy('order', 'asc')->first();
        if( is_null($page) || $page->blocks_count == 0 ) {
            return redirect()->route('dashboard');
        }

        return $this->page($page);
    }

    public function page(Page $page)
    {
        $grants = $this->grants($page);

        $page->load(['blocks' => function ($query) use ($grants) {
            $query->whereIn('grant', $grants)->orderBy('order', 'asc');
        }, 'blocks.actions' => function ($query) {
            $query->orderBy('order', 'asc');
        }]);
        return view('website.page')->with('page', $page);
    }

    public function event(Event $event)
    {
        if( is_null($event->page) ) return redirect()->route('web.home');

        return $this->page($event->page);
    }

    public function product(Product $product)
    {
        if( is_null($product->page) ) return redirect()->route('web.home');

        return $this->page($product->page);
    }

    public function tag(Tag $tag)
    {
        if( $tag->page ) return redirect()->route('web.page', $tag->page);
        else return redirect()->route('web.home');
    }

    private function grants($page)
    {
        if( Auth::check() ) {
            return ['all', 'user'];
        } else {
            return ['all', 'public'];
        }
    }
}