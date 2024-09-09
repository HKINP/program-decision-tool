<?php

namespace Modules\Report\Requests\FederalProvinceActivity;

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
            'province_id' => 'nullable|integer|exists:provinces,id',
            'ir_id' => 'required|integer',
            'outcomes_id' => 'required|integer|exists:outcomes,id',
            'activity_id' => 'nullable|integer|exists:activities,id',
            'proposed_activities' => 'required|string',
            'months' => 'nullable|array',
            'year' => 'nullable|array',
            'year.*' => 'integer|min:2000|max:' . now()->year,
            'total_target' => 'nullable|string|max:255',
            'implemented_by' => 'nullable|string',
            'remarks' => 'nullable|string',
        ];
    }
   
}
