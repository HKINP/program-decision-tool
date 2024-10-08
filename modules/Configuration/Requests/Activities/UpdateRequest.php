<?php

namespace Modules\Configuration\Requests\Activities;

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
           
            'implemented_by' => 'required',
            'activities' => 'required|string',
            'partner' => 'required|array',
            'unit' => 'required|string|max:50',
        ];
    }
  
}
