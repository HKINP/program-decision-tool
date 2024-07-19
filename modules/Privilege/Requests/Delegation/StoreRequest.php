<?php

namespace Modules\Privilege\Requests\Delegation;

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
            'to_user' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ];
    }
}
