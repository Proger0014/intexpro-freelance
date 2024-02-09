<?php

namespace App\Http\Requests\Order;

use App\Constants\ValidationConstants;
use Illuminate\Foundation\Http\FormRequest;

class GetAllInPageRequest extends FormRequest
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
            'page' => 'required|min:0'
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array {
        return [
            'page.required' => ValidationConstants::REQUIRED,
            'page.min' => sprintf(ValidationConstants::MIN, 0)
        ];
    }
}
