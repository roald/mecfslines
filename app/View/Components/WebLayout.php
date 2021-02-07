<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Page;

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
        $this->menu = Page::where('menu', true)->orderBy('order', 'asc')->get();
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
}
