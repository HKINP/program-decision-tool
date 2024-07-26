<?php

namespace Modules\Configuration\Requests\Platforms;

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
            'parent_id' => 'nullable|exists:platforms,id',
            'platforms' => 'required|string|max:255',
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
            'parent_id.exists' => 'The selected parent ID does not exist in the platforms table.',
            'platforms.required' => 'The platform field is required.',
            'platforms.string' => 'The platform must be a string.',
            'platforms.max' => 'The platform may not be greater than 255 characters.',
            'updated_by.required' => 'The updated by field is required.',
            'updated_by.exists' => 'The selected updated by user does not exist in the users table.',
        ];
    }
}
