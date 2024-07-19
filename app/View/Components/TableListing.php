<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TableListing extends Component
{
    public $title;
    public $headers;
    public $addRoute;
    public $name;
    public $useAddModal;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $headers, $addRoute,$name,$useAddModal)
    {
        $this->title = $title;
        $this->headers = $headers;
        $this->addRoute = $addRoute;
        $this->name = $name;
        $this->useAddModal = $useAddModal;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table-listing');
    }
}
