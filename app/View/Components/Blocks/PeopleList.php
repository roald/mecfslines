<?php

namespace App\View\Components\Blocks;

use Illuminate\View\Component;
use App\Models\Block;
use App\Models\Person;

class PeopleList extends Component
{
    public $block;
    public $people;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Block $block)
    {
        $this->block = $block;
        $this->people = Person::orderBy('order')->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blocks.people-list');
    }
}
