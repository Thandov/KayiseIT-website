<?php

namespace App\View\Components;

use Illuminate\View\Component;

class serviceCard extends Component
{
public $href;
public $pic;
public $servicename;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($href,$pic,$servicename) 
    {
        $this->href= $href;
        $this->pic= $pic;
        $this->servicename= $servicename;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.service-card');
    }
}