<?php

namespace App\View\Components;

use Illuminate\View\Component;

class multistepForm extends Component
{
    public $slides;
    public $linking;

    /**
     * Create a new component instance.
     *
     * @param  array  $slides
     * @return void
     */
    public function __construct($slides, $linking)
    {
        $this->slides = $slides;
        $this->linking = $linking;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.multistep-form');
    }
}
