<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DummyContent extends Component
{
    public $type; // Define the $type property, which will be passed when the component is used

    // Constructor method that sets the $type property
    public function __construct($type = 'lorem') // Default to 'lorem' if no type is passed
    {
        $this->type = $type;
    }

    public function render() // Render method to return the view
    {
        return view('components.dummy-content');
    }
}

