<?php

namespace Modules\Configuration\Requests\Province\Profile;

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
            'province_id' => 'required|exists:provinces,id|integer',
            'indicator_id' => 'required|exists:indicators,id|integer',
            'all_value' => 'required|string',
            'rural_value' => 'required|string',
            'source' => 'required|string',
            
        ];
    }
}
