<?php

namespace Modules\Configuration\Requests\Threshold;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateRequest extends FormRequest
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
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'question_id' => 'required|exists:questions,id',
            'stage_id' => 'required|exists:stages,id',
            'min_value' => 'nullable|integer|min:0',
            'max_value' => 'nullable|integer|min:0|gt:min_value',
            'color' => 'required|string|max:7',
            'threshold_text' => 'required|string|max:255',
        ];
    }
}
