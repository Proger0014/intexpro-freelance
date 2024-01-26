<?php

namespace App\Http\Requests\Auth;

use App\Constans\ValidationConstans;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;


class LoginRequest extends FormRequest
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
            'login' => "required|min:{${User::DEFAULT_MIN_LENGTH}}|max:{${User::DEFAULT_MAX_LENGTH}}",
            'password' => "required|min:{${User::DEFAULT_MIN_LENGTH}}|max:{${User::DEFAULT_MAX_LENGTH}}"
        ];
    }

    public function messages(): array
    {
        return [
            // login
            'login.required' => ValidationConstans::REQUIRED,
            'login.min' => sprintf(ValidationConstans::MIN, User::DEFAULT_MIN_LENGTH),
            'login.max' => sprintf(ValidationConstans::MAX, User::DEFAULT_MAX_LENGTH),

            // password
            'password.required' => ValidationConstans::REQUIRED,
            'password.min' => sprintf(ValidationConstans::MIN, User::DEFAULT_MIN_LENGTH),
            'password.max' => sprintf(ValidationConstans::MAX, User::DEFAULT_MAX_LENGTH)
        ];
    }
}
