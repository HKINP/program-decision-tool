<?php

namespace Modules\Configuration\Requests\Province\Profile;

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
           
            'province_id' => 'required|integer|exists:provinces,id',
            'indicator_id' => 'required|array',
            'indicator_id.*' => 'required|integer|exists:indicators,id', 
            'all_value' => 'required|array',
            'all_value.*' => 'nullable|numeric', 
            'rural_value' => 'required|array',
            'rural_value.*' => 'nullable|numeric',
            'source' => 'required|array',
            'source.*' => 'nullable|string',
        ];
      
    }
}
