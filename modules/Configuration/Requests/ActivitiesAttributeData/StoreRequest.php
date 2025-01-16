<?php

namespace Modules\Configuration\Requests\ActivitiesAttributeData;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'district_id' => 'nullable|exists:districts,id',
            'province_id' => 'nullable|exists:provinces,id',
            'event_date' => 'required|date',
            'event_location' => 'required|string',
            'activity_id' => 'required|exists:activities,id',
            
        ];
    }
    /**
     * Customize the error messages for the request.
     *
     * @return array
     */
}
