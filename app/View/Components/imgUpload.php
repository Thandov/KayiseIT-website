<?php

namespace App\View\Components;

use Illuminate\View\Component;

class imgUpload extends Component
{
    public $image;
    public $classing;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($image, $classing)
    {
        $this->image = $image;
        $this->classing = $classing;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.img-upload');
    }
}