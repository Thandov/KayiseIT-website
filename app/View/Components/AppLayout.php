<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * The component alias name.
     */
    public string $title;

    /**
     * Create the component instance.
     */
    public function __construct(string $title = 'Kayise IT')
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        // Check if we're in the admin area and dispatch an event or return an extended layout
        if (request()->is('dashboard*') || request()->is('admin/*')) {
            // For admin route
            $isAdmin = true;
        } else {
            $isAdmin = false;
        }
        
        return view('layouts.app', compact('isAdmin'));
    }
}
