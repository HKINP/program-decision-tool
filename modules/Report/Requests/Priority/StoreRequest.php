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
            'province_id' => 'required|integer',
            'district_id' => 'required|integer',
            'target_group_id' => 'required|array',
            'target_group_id.*' => 'integer',
            'thematic_area_id' => 'required|array',
            'thematic_area_id.*' => 'integer',
            'question_id' => 'required|array',
            'question_id.*' => 'integer',
            'response_all' => 'required|array',
            'response_all.*' => 'integer',
            'response_underserved' => 'required|array',
            'response_underserved.*' => 'integer',
            'priority' => 'required|array',
            'priority.*' => 'integer',
        ];
    }
}
