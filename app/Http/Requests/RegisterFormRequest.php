<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class RegisterFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login' => 'required|string|min:3|max:10|regex:/^[a-zA-Z0-9_]*$/|unique:users',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|confirmed|regex:/^.*(?=.{8,})(?=[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*"?\(\)_-]).*$/',
            'name' => 'string|nullable',
            'secondary_name' => 'string|nullable',
            'birthday' => 'date|nullable',
            'phone_number' => 'nullable|regex:/^7\d{10}$/|unique:userInfos', // у всех пользователей должен быть разный телефон
            'about' => 'string|nullable',
            'photo' => 'image|mimes:jpeg,jpg,png,svg|max:2048|nullable',
            'authors' => 'nullable',
            'authors.*' => 'exists:authors,id',
            'categories' => 'nullable',
            'categories.*' => 'exists:categories,id',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function messages(): array
    {
        return [
            'login.required' => 'Введите логин!',
            'login.unique' => 'Пользователь с таким логином уже существует!',
            'login.min' => 'Логин меньше 3 символов!',
            'login.max' => 'Логин длиннее 10 символов!',
            'login.regex' => 'Логин может содержать символы латинского алфавита, цифры и знак подчёркивания "_"!',

            'email.required' => 'Введите email!',
            'email.unique' => 'Пользователь с таким email уже существует',
            'email.email' => 'Введите корректный email',

            'password.required' => 'Введите пароль!',
            'password.confirmed' => 'Пароли не совпадают!',
            'password.regex' => 'Пароль должен быть написан латиницей, содержать минимум 8 символов, хотя бы один спец символ, хотя бы одну цифру',

            'name.string' => 'Имя должно быть строкой',
            'secondary_name.string' => 'Фамилия должна быть строкой',
            'birthday.date' => 'День рождения должен быть датой',
            'phone_number.unique' => 'Пользователь с таким номером телефона уже существует!',
            'phone_number.regex' => 'Телефон должен соответсвовать виду: 7ХХХХХХХХХХ',
            'about.string' => 'Должно быть строкой',
            'photo.image' => 'Загржуено не фото',
            'photo.mimes' => 'Поддерживаемые расширения файлов: jpeg,jpg,png,svg',
            'photo.max' => 'Размер фото превышает 2 Мб',
            'authors.*.exists' => 'Автор не существует',
            'categories.*.exists' => 'Категория не существует',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => 'Error validation',
            'errors'=>$validator->errors(),
        ], 422));
    }
}
