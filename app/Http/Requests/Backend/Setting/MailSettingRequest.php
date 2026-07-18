<?php

namespace App\Http\Requests\Backend\Setting;

use Illuminate\Foundation\Http\FormRequest;

class MailSettingRequest extends FormRequest
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
            "email_from_name" => ["required", "string"],
            "email_from_address" => ["required", "email"],
            "mailing_driver" => ["required", "string"],
            "mail_host" => ["required", "string"],
            "mail_port" => ["required", "numeric"],
            "mail_secure" => ["required", "string"],
            "mail_username" => ["required", "string"],
            "mail_password" => ["required", "string"],
        ];
    }

    public function messages(): array
    {
        return [
            'email_from_name.required' => 'The "From Name" field is required.',
            'email_from_name.string' => 'The "From Name" must be a valid string.',

            'email_from_address.required' => 'The "From Email Address" is required.',
            'email_from_address.email' => 'The "From Email Address" must be a valid email.',

            'mailing_driver.required' => 'The mail driver is required.',
            'mailing_driver.string' => 'The mail driver must be a valid string.',

            'mail_host.required' => 'The mail host is required.',
            'mail_host.string' => 'The mail host must be a valid string.',

            'mail_port.required' => 'The mail port is required.',
            'mail_port.numeric' => 'The mail port must be a number.',

            'mail_secure.required' => 'The mail encryption method is required.',
            'mail_secure.string' => 'The mail encryption must be a valid string.',

            'mail_username.required' => 'The mail username is required.',
            'mail_username.string' => 'The mail username must be a valid string.',

            'mail_password.required' => 'The mail password is required.',
            'mail_password.string' => 'The mail password must be a valid string.',
        ];
    }
}
