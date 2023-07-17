<?php

namespace App\View\Components;

use Illuminate\View\Component;

class modal extends Component
{
    public $name;
    public $linking;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $linking)
    {
        $this->name = $name;
        $this->linking = $linking;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal');
    }
}
