<?php

namespace Modules\Configuration\Requests\District\Profile;

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
                'district_id' => 'required|exists:districts,id',
                'indicator_id' => 'required|exists:indicators,id',
                'all_value' => 'required',
            ];
      
    }
}
