<?php

namespace Modules\Configuration\Requests\Indicators;

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
            'indicator_name' => 'required|string|max:255',
            'thematic_area_id' => 'required',
            'stage_id' => 'nullable|exists:stages,id',
        ];
    }
    
}
