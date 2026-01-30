<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Buttn extends Component
{
    public $link;
    public $title;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($link, $title)
    {
        $this->link = $link;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.buttn');
    }
}
