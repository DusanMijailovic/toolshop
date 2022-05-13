<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|min:3|max:20|regex:/^[A-Z][a-z]{2,15}\s[A-Z][a-z]{2,15}$/',
            'email' => 'required|email|unique:user',
            'password' => 'required|min:8|regex:/^[a-z0-9]{8,}$/'
        ] ;
    }

    public function messages()
    {
        return [
            'name.required' => 'Morate upisati ime',
            'email.required'  => 'Мorate upisati email',
        ];
    }
}
