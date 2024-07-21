<?php

namespace Modules\Configuration\Requests\Question;

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
            'question' => 'required|string|max:255',
            'stages' => 'required|array',
            'stages.*' => 'exists:stages,id',
        ];
    }
}
