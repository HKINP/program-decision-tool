<?php

namespace Modules\Configuration\Requests\Outcomes;

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
            'ir_id' => 'required',
            'outcome' => 'required|string|max:255',
            'total_budget' => 'required|string|max:255',
        ];
    }
    /**
     * Customize the error messages for the request.
     *
     * @return array
     */
}
