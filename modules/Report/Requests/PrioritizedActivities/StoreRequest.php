<?php

namespace Modules\Report\Requests\PrioritizedActivities;

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
        'stage_id' => 'required|integer',
        'key_barriers' => 'nullable|string',
        'indicator_id' => 'required|integer',
        'target_group_id' => 'required|integer',
        'thematic_area_id' => 'required|integer',
        'activities.*' => 'required|string',
        'targetted_for.*' => 'required|string',
        'platform_id.*' => 'required|integer',
        'remarks.*' => 'nullable|string',
        'notes' => 'nullable|string',
        ];
        
    }
}
