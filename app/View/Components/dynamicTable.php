<?php

namespace App\View\Components;

use Illuminate\View\Component;

class dynamicTable extends Component
{
    public $thead;
    public $trcontent;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($thead, $trcontent)
    {
        $this->thead = $thead;
        $this->trcontent = $trcontent;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dynamic-table');
    }
}
