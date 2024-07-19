<?php

namespace Modules\Privilege\Requests\User;

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
            'roles' => 'required',
            'office_id' => 'required|exists:offices,id',
            'department_id' => 'required|exists:departments,id',
            'full_name' => 'required',
            'email_address'=>'required|email|unique:users,email_address',
            'password'=>'required|min:6',
            'confirm_password'=>'required|same:password'
        ];
    }
}
