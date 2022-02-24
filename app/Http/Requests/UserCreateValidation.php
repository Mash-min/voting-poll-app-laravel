<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|unique:users|min:8',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed|min:8'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Username is required',
            'username.unique' => 'Username is not available',
            'username:min' => 'Username minimum of 8 characters',
            'email.required' => 'Email is required',
            'email.unique' => 'Email is not available',
            'password.required' => 'Password is required',
            'password.min' => 'Password minimum of 8 characters'
        ];
    }
}
