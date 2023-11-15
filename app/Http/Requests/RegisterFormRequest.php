<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login' => 'required|string|unique:users',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|confirmed|regex:/^.*(?=.{8,})(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*"?]).*$/',
            'name' => 'string|nullable',
            'secondary_name' => 'string|nullable',
            'birthday' => 'date|nullable',
            'phone_number' => 'nullable|regex:/(7)[0-9]{10}/|unique:user_infos', // у всех пользователей должен быть разный телефон
            'about' => 'string|nullable',
            'photo' => 'image|mimes:jpeg,jpg,png,svg|max:2048|nullable',
            'authors' => 'exists:authors,id|nullable',
            'categories' => 'exists:categories,id|nullable'
        ];
    }
}
