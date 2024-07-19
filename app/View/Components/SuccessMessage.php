<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SuccessMessage extends Component
{
    public $message;

    /**
     * Create a new component instance.
     *
     * @param string $message
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.success-message');
    }
}
