<?php

namespace Modules\Report\Requests\PrioritizedActivities;

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
            'province_id' => 'required|integer|exists:provinces,id',
            'district_id' => 'required|integer|exists:districts,id',
            'stage_id' => 'required|integer|exists:stages,id',
            'target_group_id' => 'required|integer|exists:target_groups,id',
            'thematic_area_id' => 'required|integer|exists:thematic_areas,id',
            'indicator_id' => 'required|integer|exists:indicators,id',
            'platforms_id' => 'required|integer|exists:platforms,id',
            'proposed_activities' => 'required|string',
            'targeted_for' => 'required|string',
            'remarks' => 'nullable|string',
        ];
    }
   
}
