<?php

namespace App\View\Components;

use Illuminate\View\Component;

class postForm extends Component
{
    public $action;
    public $post;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($action, $post)
    {
        $this->action = $action;
        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.post-form');
    }
}
