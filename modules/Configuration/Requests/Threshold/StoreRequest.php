<?php

namespace Modules\Configuration\Requests\Threshold;

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
            'stage_id' => 'required|integer',
            'question_id' => 'required|integer',
            'min_value' => 'required|array',
            'min_value.*' => 'numeric', // Validation rule for each element in the min_value array
            'max_value' => 'required|array',
            'max_value.*' => 'numeric', // Validation rule for each element in the max_value array
            'color' => 'required|array',
            'color.*' => 'string', // Validation rule for each element in the color array
            'recommendation' => 'required|array',
            'recommendation.*' => 'string', // Validation rule for each element in the recommendation array
        ];
    }
}
