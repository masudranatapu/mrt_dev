<?php

namespace App\Http\Requests\Backend\Setting;

use Illuminate\Foundation\Http\FormRequest;

class MetaSettingRequest extends FormRequest
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
            "meta_title" => ["required", "string"],
            "meta_image" => [
                "nullable",
                "image",
                "mimes:png,ico,jpg,jpeg,webp",
                "max:5120",
            ],
            "meta_keywords" => ["required", "string"],
            "meta_description" => ["required", "string"],
        ];
    }

    public function messages(): array
    {
        return [
            'email_verification.required' => 'The email verification status is required.',
            'email_verification.in' => 'The email verification status must be either Yes or No.',

            'phone_verification.required' => 'The phone verification status is required.',
            'phone_verification.in' => 'The phone verification status must be either Yes or No.',

            'otp_verification.required' => 'The OTP verification status is required.',
            'otp_verification.in' => 'The OTP verification status must be either Yes or No.',
        ];
    }
}
