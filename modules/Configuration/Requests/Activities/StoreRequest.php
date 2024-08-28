<?php

namespace Modules\Configuration\Requests\Activities;

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
            'outcomes_id' => 'nullable|exists:outcomes,id',
            'ir_id' => 'required',
            'activities' => 'required|string|max:255',
        ];
    }
    /**
     * Customize the error messages for the request.
     *
     * @return array
     */
}
