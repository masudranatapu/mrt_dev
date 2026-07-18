<?php

namespace App\Http\Requests\Backend\Setting;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SystemLogoutRequest extends FormRequest
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
            "specific_user" => ["required", "in:All,Specific"],
            "user_ids" => ["required_if:specific_user,Specific", "array"],
            "user_ids.*" => [
                Rule::exists('users', 'id')
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'specific_user.required' => 'The logout type is required.',
            'specific_user.in' => 'The logout type must be either "All" or "Specific".',
            'user_ids.required_if' => 'User IDs are required when logging out specific users.',
            'user_ids.array' => 'User IDs must be provided as an array.',
            'user_ids.min' => 'At least one user ID must be provided.',
            'user_ids.*.exists' => 'One or more user IDs do not exist in our records.',
        ];
    }
}
