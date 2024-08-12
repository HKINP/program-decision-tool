<?php

namespace Modules\Report\Requests\StepRemarks;

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
            'province_id' => 'required|exists:provinces,id',
            'district_id' => 'required|exists:districts,id',
            'stage_id' => 'required|integer',
            'notes' => 'nullable|string',
            'key_barriers' => 'nullable|string',
        ];
    }
   
}
