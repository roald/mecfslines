<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Multimedia extends Component
{
    public $multimedia;
    public $size;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($multimedia, $size = 'thumb')
    {
        $this->multimedia = $multimedia;
        $this->size = $size;
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
