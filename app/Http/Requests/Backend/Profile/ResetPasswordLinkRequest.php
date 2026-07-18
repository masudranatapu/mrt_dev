<?php

namespace App\Http\Requests\Backend\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ResetPasswordLinkRequest extends FormRequest
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
        $routePrefix = $this->route()?->getPrefix();

        $existTableData = str_contains($routePrefix, 'api/customer') ? 'customers' : 'users';

        return [
            "email" => [
                "required",
                "email",
                "max:40",
                Rule::exists($existTableData, 'email')
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'The email must not exceed 40 characters.',
            'email.exists' => 'The provided email does not exist in our records.',
        ];
    }
}
