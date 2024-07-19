<?php

namespace Modules\Privilege\Requests\SupportStaff;

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
            'office_id' => 'required|exists:offices,id',
            'full_name' => 'required',
            'phone_number'=>'required',
            'designation'=>'required',
            'employee_code'=>'required',
        ];
    }
}
