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
            'stage_id' => 'required|integer',
            'province_id' => 'required|integer',
            'district_id' => 'required|integer',
            'tag_id' => 'required|integer',
            'question_id' => 'required|integer',
            'response_all' => 'nullable|string',
            'response_underserved' => 'nullable|string',
        ];
    }
   
}
