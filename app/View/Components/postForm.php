<?php

namespace App\View\Components;

use Illuminate\View\Component;

class postForm extends Component
{
    public $action;
    public $post;
    public $buttonlinking;
    public $buttoncolor;
    public $buttonshowme;
    public $buttonname;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($action, $post, $buttonlinking, $buttoncolor, $buttonshowme, $buttonname)
    {
        $this->action = $action;
        $this->post = $post;
        $this->buttonlinking = $buttonlinking;
        $this->buttoncolor = $buttoncolor;
        $this->buttonshowme = $buttonshowme;
        $this->buttonname = $buttonname;
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