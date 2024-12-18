<?php

namespace App\View\Components\Blocks;

use Illuminate\View\Component;
use App\Models\Block;
use App\Models\Project;

class ProjectsList extends Component
{
    public $block;
    public $projects;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Block $block)
    {
        $this->block = $block;
        $this->projects = Project::where('status', 'active')->orderBy('published_at', 'desc')->get();   
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blocks.projects-list');
    }
}
