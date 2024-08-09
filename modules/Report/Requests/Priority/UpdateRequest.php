<?php

namespace Modules\Report\Requests\Priority;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
       
      
        return [
           'priority' => 'required',
        ];
    }
   
}
