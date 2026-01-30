<?php

namespace App\View\Components;

use Illuminate\View\Component;

class frontEndBtn extends Component
{
    public $linking;
    public $color;
    public $showme;
    public $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($linking, $color, $showme, $name)
    {
        $this->linking = $linking;
        $this->color = $color;
        $this->showme = $showme;
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.front-end-btn');
    }
}
