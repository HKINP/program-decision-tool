<?php

namespace Modules\Configuration\Requests\District\Profile;

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
            'district_id' => 'required|exists:districts,id|integer',
                'indicator_id' => 'required|exists:indicators,id|integer',
                'all_value' => 'required|string',
                'source' => 'required|string',
            
        ];
    }
}
