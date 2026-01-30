<?php

namespace App\View\Components;

use Illuminate\View\Component;

class titlestyle extends Component
{
    public $smheading;
    public $bgheading;
    public $smheadingcolor;
    public $bgheadingcolor;
    public $alignment;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($smheading, $bgheading, $smheadingcolor, $bgheadingcolor, $alignment)
    {
        $this->smheading = $smheading;
        $this->bgheading = $bgheading;
        $this->smheadingcolor = $smheadingcolor;
        $this->bgheadingcolor = $bgheadingcolor;
        $this->alignment = $alignment;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.titlestyle');
    }
}
