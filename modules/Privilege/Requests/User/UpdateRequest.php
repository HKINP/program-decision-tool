<?php

namespace Modules\Privilege\Requests\User;

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
            'roles' => 'required',
            'full_name' => 'required',
            'office_id' => 'required|exists:offices,id',
            'department_id' => 'required|exists:departments,id',
            'email_address'=>'required|email|unique:users,email_address,'.$request->get('id').',id',
        ];
    }
}
