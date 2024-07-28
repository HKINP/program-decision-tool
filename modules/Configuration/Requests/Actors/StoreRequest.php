<?php

namespace Modules\Configuration\Requests\Actors;

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
            'parent_id' => 'nullable|exists:actors,id',
            'actors' => 'required|string|max:255',
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
            'parent_id.exists' => 'The selected parent ID does not exist in the actors table.',
            'actors.required' => 'The platform field is required.',
            'actors.string' => 'The platform must be a string.',
            'actors.max' => 'The platform may not be greater than 255 characters.',
        ];
    }
}
