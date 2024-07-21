<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormComponent extends Component
{
       
    public $action;
    public $method;
    public $fields;
    public $values;

    public function __construct($action, $method = 'POST', $fields = [], $values = [])
    {
        $this->action = $action;
        $this->method = $method;
        $this->fields = $fields;
        $this->values = $values;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-component');
    }
}
