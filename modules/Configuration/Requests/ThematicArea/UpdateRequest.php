<?php

namespace Modules\Configuration\Requests\ThematicArea;
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
            'thematic_area' => 'required|string|max:255',
            'target_group_id.*' => 'exists:target_groups,id', // Validate each target_group_id
        ];
    }
}
