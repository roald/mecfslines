<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Page;
use Auth;

class WebLayout extends Component
{
    public $menu;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->menu = Page::where('menu', true)->whereIn('status', $this->grants())->orderBy('order', 'asc')->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('layouts.web');
    }

    /**
     * Determine which pages should be shown in the menu
     */
    private function grants()
    {
        if( Auth::check() && Auth::user()->isAdmin() ) {
            return ['active', 'concept', 'user'];
        } elseif( Auth::check() ) {
            return ['active', 'user'];
        } else {
            return ['active'];
        }
    }
}
