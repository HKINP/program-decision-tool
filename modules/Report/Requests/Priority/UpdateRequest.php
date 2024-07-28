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
            'target_group_id' => 'required',
            'thematic_area_id' => 'required',
            'question_id' => 'required',
            'response_all' => 'required',
            'response_underserved' => 'required',
            'priority' => 'required',
        ];
    }
   
}
