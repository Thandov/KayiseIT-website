<?php

namespace App\View\Components;

use Illuminate\View\Component;

class carouselForm extends Component
{
    public $route;
    public $slides;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($route, $slides)
    {
        $this->route = $route;
        $this->slides = $slides;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.carousel-form');
    }
}
