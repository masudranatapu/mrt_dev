<?php

namespace App\Http\Requests\Backend\Auth;


use Illuminate\Foundation\Http\FormRequest;

class AdminLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            "email" => ["required", "email", "max:40", "exists:users,email"],
            "password" => ["required", "min:4", "max:25"],
            "remember_me" => ["nullable", "boolean"],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'The email must not exceed 40 characters.',
            'email.exists' => 'The provided email does not exist in our records.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 4 characters long.',
            'password.max' => 'The password must not exceed 25 characters.',
            'remember_me.boolean' => 'The remember me field must be true or false.',
        ];
    }
}
