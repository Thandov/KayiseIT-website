<?php

namespace App\View\Components;

use Illuminate\View\Component;

class HeroBanner extends Component
{
    public $hero;
    public $title;
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public function __construct($hero, $title)
    {
        $this->hero = $hero;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.hero-banner');
    }
}
