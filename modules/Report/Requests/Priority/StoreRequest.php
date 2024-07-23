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
            'target_group_id' => 'required|integer',
            'thematic_area_id' => 'required|integer',
            'question_id' => 'required|integer',
            'priority' => 'required|integer',
            'updated_by' => 'required|integer',
        ];
    }
}
