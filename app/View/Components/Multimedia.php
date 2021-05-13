<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Multimedia extends Component
{
    public $multimedia;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($multimedia)
    {
        $this->multimedia = $multimedia;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.multimedia');
    }
}
