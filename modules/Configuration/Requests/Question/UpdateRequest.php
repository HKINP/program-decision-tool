<?php

namespace Modules\Configuration\Requests\Question;

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
            'question' => 'required|string|max:255',
            'thematic_area_id' => 'nullable|exists:thematic_areas,id',
            'indicator_id' => 'required',
            'target_group_id' => 'nullable|exists:target_groups,id',
            'updated_by' => 'nullable|exists:users,id',
        ];
    }
}
