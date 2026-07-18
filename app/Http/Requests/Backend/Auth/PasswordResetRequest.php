<?php

namespace App\Http\Requests\Backend\Auth;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
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
            "token" => ["required"],
            "password" => ["required", "string", "min:4", "max:25", "confirmed"],
        ];
    }

    public function messages(): array
    {
        return [
            'token.required' => 'The token field is required.',
            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be string.',
            'password.min' => 'The password must be at least 4 characters.',
            'password.max' => 'The password may not be greater than 25 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
        ];
    }
}
