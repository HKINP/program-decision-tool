<?php

namespace Modules\Configuration\Requests\Actions;

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
            'parent_id' => 'nullable|exists:actions,id',
            'actions' => 'required|string|max:255',
        ];
    }
    /**
     * Customize the error messages for the request.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'parent_id.exists' => 'The selected parent ID does not exist in the actions table.',
            'actions.required' => 'The platform field is required.',
            'actions.string' => 'The platform must be a string.',
            'actions.max' => 'The platform may not be greater than 255 characters.',
        ];
    }
}
