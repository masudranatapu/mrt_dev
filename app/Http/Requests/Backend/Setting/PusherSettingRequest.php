<?php

namespace App\Http\Requests\Backend\Setting;

use Illuminate\Foundation\Http\FormRequest;

class PusherSettingRequest extends FormRequest
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
            "pusher_app_id" => ["required", "string"],
            "pusher_key" => ["required", "string"],
            "pusher_secret" => ["required", "string"],
            "pusher_cluster" => ["required", "string"],
        ];
    }

    public function messages(): array
    {
        return [
            'pusher_app_id.required' => 'The Pusher App ID is required.',
            'pusher_app_id.string' => 'The Pusher App ID must be a valid string.',

            'pusher_key.required' => 'The Pusher key is required.',
            'pusher_key.string' => 'The Pusher key must be a valid string.',

            'pusher_secret.required' => 'The Pusher secret is required.',
            'pusher_secret.string' => 'The Pusher secret must be a valid string.',

            'pusher_cluster.required' => 'The Pusher cluster is required.',
            'pusher_cluster.string' => 'The Pusher cluster must be a valid string.',
        ];
    }
}
