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
           'ir_id' => 'required|integer',
            'outcomes_id' => 'required|integer',
            'activities' => 'required|string|max:255',
            'partner' => 'required|array',
            'unit' => 'required|string|max:50',
        ];
    }
    /**
     * Customize the error messages for the request.
     *
     * @return array
     */
}
