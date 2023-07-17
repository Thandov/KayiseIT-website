<?php

namespace App\View\Components;

use Illuminate\View\Component;

class teamCard extends Component
{
    public $linking;
    public $name;
    public $surname;
    public $position;
    public $image;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($linking, $name, $surname, $position, $image)
    {
        $this->linking = $linking;
        $this->name = $name;
        $this->surname = $surname;
        $this->position = $position;
        $this->image = $image;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.team-card');
    }
}
