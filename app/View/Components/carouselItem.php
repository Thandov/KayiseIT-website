<?php

namespace App\View\Components;

use Illuminate\View\Component;

class carouselItem extends Component
{

public $pic;
public $topTitle;
public $mainTitle;
public $bottomTitle;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($pic, $topTitle, $mainTitle, $bottomTitle)
    {
        $this->pic= $pic;
        $this->topTitle= $topTitle;
        $this->mainTitle= $mainTitle;
        $this->bottomTitle= $bottomTitle;        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.carousel-item');
    }
}