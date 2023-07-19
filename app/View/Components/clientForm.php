<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Client;

class clientForm extends Component
{
    public $client;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($client = null)
    {
        $this->client = $client; // Set an empty Client instance as the default if $client is null
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.client-form');
    }
}
