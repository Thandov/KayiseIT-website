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
    public $isCarouselSlide;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($action, $post, $buttonlinking, $buttoncolor, $buttonshowme, $buttonname, $isCarouselSlide = false)
    {
        $this->action = $action;
        $this->post = $post;
        $this->buttonlinking = $buttonlinking;
        $this->buttoncolor = $buttoncolor;
        $this->buttonshowme = $buttonshowme;
        $this->buttonname = $buttonname;
        $this->isCarouselSlide = filter_var($isCarouselSlide, FILTER_VALIDATE_BOOLEAN);
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