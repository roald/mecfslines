<?php

namespace App\View\Components\Blocks;

use Illuminate\View\Component;
use App\Models\Block;

class PersonInfo extends Component
{
    public $block;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Block $block)
    {
        $this->block = $block;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blocks.person-info');
    }
}
