<?php

namespace App\Http\Requests\Backend\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SmsSettingRequest extends FormRequest
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
            "sms_username" => ["nullable", "string"],
            "sms_password" => ["nullable", "string"],
            "sms_sender_id" => ["nullable", "string"],
            "sms_api_key" => ["nullable", "string"],
            "sms_base_url" => ["nullable", "url"],
            "sms_type" => ["nullable", "string"],
        ];
    }

    public function messages(): array
    {
        return [
            'sms_username.required' => 'The SMS username is required.',
            'sms_username.string' => 'The SMS username must be a valid string.',

            'sms_password.required' => 'The SMS password is required.',
            'sms_password.string' => 'The SMS password must be a valid string.',

            'sms_sender_id.required' => 'The SMS sender ID is required.',
            'sms_sender_id.string' => 'The SMS sender ID must be a valid string.',

            'sms_api_key.required' => 'The SMS API key is required.',
            'sms_api_key.string' => 'The SMS API key must be a valid string.',

            'sms_base_url.required' => 'The SMS base URL is required.',
            'sms_base_url.url' => 'The SMS base URL must be a valid URL.',

            'sms_type.required' => 'The SMS type is required.',
            'sms_type.string' => 'The SMS type must be a valid string.',
        ];
    }
}
