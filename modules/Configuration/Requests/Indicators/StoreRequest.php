<?php

namespace Modules\Configuration\Requests\Indicators;

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
            'indicator_name' => 'required|string|max:255',
            'thematic_area_id' => 'required',
            'stage_id' => 'nullable|exists:stages,id',
        ];
    }
    
}
