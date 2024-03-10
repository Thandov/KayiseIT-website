<?php

namespace App\View\Components;

use Illuminate\View\Component;

class imgCard extends Component
{
    public $pic;
    public $picid;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($pic, $picid)
    {
        //
        $this->pic = $pic;
        $this->picid = $picid;
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
