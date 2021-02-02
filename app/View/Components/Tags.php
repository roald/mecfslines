<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Tag;

class Tags extends Component
{
    public $object;
    public $route;
    public $tags;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($object)
    {
        $this->object = $object;
        $this->route = strtolower(class_basename($object)). 's.tagging';
        $this->tags = Tag::whereNotIn('id', $object->tags()->pluck('id'))->orderBy('name', 'asc')->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.tags');
    }
}
