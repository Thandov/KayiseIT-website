<?php

namespace App\View\Components;

use Illuminate\View\Component;

class provinceSelected extends Component
{
    public $client;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.province-selected');
    }
}
