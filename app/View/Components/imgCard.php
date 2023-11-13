<?php

namespace App\View\Components;

use Illuminate\View\Component;

class imgCard extends Component
{
    public $pic;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($pic)
    {
        //
        $this->pic = $pic;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.img-card');
    }
}
