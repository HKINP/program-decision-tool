<?php

namespace Modules\Report\Requests\Priority;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
     
        return [
           
            'province_id.*' => 'required|integer|exists:provinces,id',
            'district_id.*' => 'required|integer|exists:districts,id',
            'question_id.*' => 'required|integer|exists:questions,id',
            'target_group_id.*' => 'required|integer|exists:target_groups,id',
            'thematic_area_id.*' => 'required|integer|exists:thematic_areas,id',
            'priority.*' => 'nullable|integer', 
        ];
    }
}
