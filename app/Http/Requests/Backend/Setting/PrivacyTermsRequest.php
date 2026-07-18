<?php

namespace App\Http\Requests\Backend\Setting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PrivacyTermsRequest extends FormRequest
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
            "type" => [
                "required",
                Rule::in(["privacy", "terms"])
            ],
            "privacy_policy" => [
                'required_if:type,privacy'
            ],
            "terms_condition" => [
                'required_if:type,terms'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => 'Type field is required.',
            'type.in' => 'Type must be either privacy or terms.',

            'privacy_policy.required_if' => 'Privacy policy is required when type is privacy.',

            'terms_condition.required_if' => 'Terms & condition is required when type is terms.',
        ];
    }
}
