<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'login' => 'required|min:10|max:30',
            'password' => 'required|min:8|max:30',
            'roles' => 'required|array',
            'roles.*' => 'required|digits_between:0,2000'
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array {
        return [
            'login.required' => ':attribute не указан',
            'login.min' => ':attribute должен быть не меньше 10 символов',
            'login.max' => ':attribute должен быть не больше 30 символов',

            'password.required' => ':attribute не указан',
            'password.min' => ':attribute должен быть не меньше 10 символов',
            'password.max' => ':attribute должен быть не больше 30 символов'
        ];
    }
}
