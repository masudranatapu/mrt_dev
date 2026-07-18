<?php

namespace App\Http\Requests\Backend\Setting;

use Illuminate\Foundation\Http\FormRequest;

class PermissionSettingRequest extends FormRequest
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
            "email_verification" => ["required", "in:Yes,No"],
            "phone_verification" => ["required", "in:Yes,No"],
            "otp_verification" => ["required", "in:Yes,No"],
            "debug_mode" => ["required", "in:Yes,No"],
            "mail_status" => ["required", "in:Active,Inactive"],
            "pusher_status" => ["required", "in:Active,Inactive"],
            "sms_status" => ["required", "in:Active,Inactive"],
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

            'debug_mode.required' => 'The debug mode status is required.',
            'debug_mode.in' => 'The debug mode status must be either Yes or No.',

            'mail_status.required' => 'The mail status is required.',
            'mail_status.in' => 'The mail status must be either Active or Inactive.',

            'pusher_status.required' => 'The pusher status is required.',
            'pusher_status.in' => 'The pusher status must be either Active or Inactive.',

            'sms_status.required' => 'The sms status is required.',
            'sms_status.in' => 'The sms status must be either Active or Inactive.',

        ];
    }
}
