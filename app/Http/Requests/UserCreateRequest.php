<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return array|string[]
     */
    public function rules()
    {
        return [
            'name' => "required | max:255",
            'email' => "required | max:255 | unique:users,email",
            'password' => "required | confirmed | min:6",
            'password_confirmation' => "min:6",
            'role_id' => "required",
        ];
    }

    /**
     * @return array|string[]
     */
    public function attributes()
    {
        return [
            'name' => "Adı Soyadı",
            'email' => "Email Adresi",
            'password' => "Şifre",
            'password_confirmation' => "Şifre Tekrar",
            'role_id' => "Tipi",
        ];
    }
}
