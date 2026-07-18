<?php

namespace App\Http\Requests\Backend\Setting;

use Illuminate\Foundation\Http\FormRequest;

class BasicSettingRequest extends FormRequest
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
            // Site Information
            "site_title" => ["required", "string", "max:30"],
            "site_email" => ["required", "email", "max:100"],
            "phone" => ["required", "string", "min:5", "max:15", "regex:/^[\d\s\-\+\(\)]+$/"],
            "address" => ["required", "string", "min:2", "max:150"],
            "copyright_text" => ["required", "string", "max:255"],
            "site_currency" => ["required", "string", "size:3", "uppercase"],
            "currency_symbol" => ["required", "string", "max:5"],
            "session_lifetime" => ["required", "integer", "min:1", "max:1440"],
            "session_expired" => ["required", "integer", "min:1", "max:1440"],
            "site_timezone" => ["required", "string", "timezone"],
            "site_url_link" => ["nullable", "url", "max:255"],
            "default_checkin" => ["nullable"],
            "default_checkout" => ["nullable", "after:default_checkin"],
            "support_email" => ["nullable", "email", "max:100"],
            "backup_email" => ["nullable", "email", "max:100"],
            "google_drive_folder_id" => ["nullable", "string"],
            "site_logo" => [
                "nullable",
                "image",
                "mimes:png,jpg,jpeg,webp",
                "max:5120",
            ],
            "site_favicon" => [
                "nullable",
                "image",
                "mimes:png,ico,jpg,jpeg,webp",
                "max:5120",
            ],
            "weekends" => ["required", "array", "min:1", "max:6"],
            "weekends.*" => ["string", "in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday"],
            "youtube_link" => ["nullable", "url", "starts_with:https://youtube.com,https://www.youtube.com"],
            "facebook_link" => ["nullable", "url", "starts_with:https://facebook.com,https://www.facebook.com"],
            "x_link" => ["nullable", "url", "starts_with:https://x.com,https://twitter.com"],
            "instagram_link" => ["nullable", "url", "starts_with:https://instagram.com"],
            "linkedin_link" => ["nullable", "url", "starts_with:https://linkedin.com"]
        ];
    }

    public function messages(): array
    {
        return [
            // Site Information
            'site_title.required' => 'The site title is required.',
            'site_title.string' => 'The site title must be a string.',
            'site_title.max' => 'The site title may not be greater than 30 characters.',

            'site_email.required' => 'The site email is required.',
            'site_email.email' => 'The site email must be a valid email address.',
            'site_email.max' => 'The site email may not be greater than 100 characters.',

            'phone.required' => 'The phone number is required.',
            'phone.string' => 'The phone number must be a string.',
            'phone.min' => 'The phone number must be at least 5 characters.',
            'phone.max' => 'The phone number may not be greater than 15 characters.',
            'phone.regex' => 'The phone number format is invalid. Only digits, spaces, and +-() are allowed.',

            'address.required' => 'The address is required.',
            'address.string' => 'The address must be a string.',
            'address.min' => 'The address must be at least 2 characters.',
            'address.max' => 'The address may not be greater than 150 characters.',

            'copyright_text.required' => 'The copyright text is required.',
            'copyright_text.string' => 'The copyright text must be a string.',
            'copyright_text.max' => 'The copyright text may not be greater than 255 characters.',

            'site_currency.required' => 'The site currency is required.',
            'site_currency.string' => 'The site currency must be a string.',
            'site_currency.size' => 'The site currency must be exactly 3 characters.',
            'site_currency.uppercase' => 'The site currency must be in uppercase.',

            'currency_symbol.required' => 'The currency symbol is required.',
            'currency_symbol.string' => 'The currency symbol must be a string.',
            'currency_symbol.max' => 'The currency symbol may not be greater than 5 characters.',

            'session_lifetime.required' => 'The session lifetime is required.',
            'session_lifetime.integer' => 'The session lifetime must be an integer.',
            'session_lifetime.min' => 'The session lifetime must be at least 1 minute.',
            'session_lifetime.max' => 'The session lifetime may not be greater than 1440 minutes (24 hours).',

            'session_expired.required' => 'The session expired time is required.',
            'session_expired.integer' => 'The session expired time must be an integer.',
            'session_expired.min' => 'The session expired time must be at least 1 minute.',
            'session_expired.max' => 'The session expired time may not be greater than 1440 minutes (24 hours).',

            'site_timezone.required' => 'The site timezone is required.',
            'site_timezone.string' => 'The site timezone must be a string.',

            'support_email.email' => 'The support email must be a valid email address.',
            'support_email.max' => 'The support email may not be greater than 100 characters.',

            'backup_email.email' => 'The database backup email must be a valid email address.',
            'backup_email.max' => 'The database backup email may not be greater than 100 characters.',

            'google_drive_folder_id.string' => 'The google drive folder id must be a string.',

            'site_url_link.url' => 'The site URL must be a valid URL.',
            'site_url_link.max' => 'The site URL may not be greater than 255 characters.',

            'default_checkin.required' => 'The default check-in time is required.',
            'default_checkin.date_format' => 'The default check-in time must be in the format HH:MM',

            'default_checkout.required' => 'The default check-out time is required.',
            'default_checkout.date_format' => 'The default check-out time must be in the format HH:MM',
            'default_checkout.after' => 'The default check-out time must be after the default check-in time.',

            'site_logo.image' => 'The site logo must be an image.',
            'site_logo.mimes' => 'The site logo must be a file of type: png, jpg, jpeg, webp.',
            'site_logo.max' => 'The site logo may not be greater than 5MB.',

            'site_favicon.image' => 'The site favicon must be an image.',
            'site_favicon.mimes' => 'The site favicon must be a file of type: png, ico, jpg, jpeg, webp.',
            'site_favicon.max' => 'The site favicon may not be greater than 1MB.',

            'weekends.required' => 'At least one weekend day is required.',
            'weekends.array' => 'The weekends must be an array.',
            'weekends.min' => 'At least one weekend day is required.',
            'weekends.max' => 'You may not select more than 6 weekend days.',
            'weekends.*.string' => 'Each weekend day must be a string.',
            'weekends.*.in' => 'The selected weekend day is invalid. Valid options are Monday through Sunday.',

            'youtube_link.url' => 'The youtube link must be a valid URL.',
            'youtube_link.starts_with' => 'The youtube link must start with https://youtube.com or https://www.youtube.com.',

            'facebook_link.url' => 'The Facebook link must be a valid URL.',
            'facebook_link.starts_with' => 'The Facebook link must start with https://facebook.com or https://www.facebook.com.',

            'x_link.url' => 'The X (Twitter) link must be a valid URL.',
            'x_link.starts_with' => 'The X (Twitter) link must start with https://x.com or https://twitter.com.',

            'instagram_link.url' => 'The Instagram link must be a valid URL.',
            'instagram_link.starts_with' => 'The Instagram link must start with https://instagram.com.',

            'linkedin_link.url' => 'The LinkedIn link must be a valid URL.',
            'linkedin_link.starts_with' => 'The LinkedIn link must start with https://linkedin.com.',
        ];
    }
}
