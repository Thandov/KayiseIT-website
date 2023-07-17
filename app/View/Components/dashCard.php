<?php

namespace App\View\Components;

use Illuminate\View\Component;

class dashCard extends Component
{
    public $name;
    public $href;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $href)
    {
        $this->name = $name;
        $this->href = $href;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dash-card');
    }
}
