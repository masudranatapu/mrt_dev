<?php

namespace App\Http\Requests\Backend\Team;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TeamRequest extends FormRequest
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
        $id = $this->route('id');

        return [
            "designation" => [
                "nullable",
                "string",
                "max:255"
            ],
            "department" => [
                "nullable",
                "string",
                "max:255"
            ],
            "avatar" => [
                $id ? "nullable" : "required",
                "file",
                "mimes:png,jpg,jpeg,webp,svg",
                "max:5120" // 5MB
            ],
            "name" => [
                "required",
                "string",
                "max:255"
            ],
            "phone" => [
                "nullable",
                "string",
                "max:255"
            ],
            "email" => [
                "nullable",
                "email",
                "max:255"
            ],
            "address" => [
                "nullable",
                "string",
                "max:255"
            ],
            "facebook_link" => [
                "nullable",
                "url",
                "max:255"
            ],
            "x_link" => [
                "nullable",
                "url",
                "max:255"
            ],
            "instagram_link" => [
                "nullable",
                "url",
                "max:255"
            ],
            "linkedin_link" => [
                "nullable",
                "url",
                "max:255"
            ],
            "status" => [
                "required",
                Rule::in(["Active", "Inactive"])
            ],
        ];
    }

    public function messages(): array
    {
        return [
            "avatar.required" => "Avatar is required.",
            "avatar.file" => "Avatar must be a valid file.",
            "avatar.mimes" => "Avatar must be a file of type: png, jpg, jpeg, webp, svg.",
            "avatar.max" => "Avatar size must not exceed 5MB.",

            "name.required" => "Name is required.",
            "name.string" => "Name must be a valid text.",
            "name.max" => "Name cannot exceed 255 characters.",

            "email.email" => "Email must be a valid email address.",

            "facebook_link.url" => "Facebook link must be a valid URL.",
            "x_link.url" => "X (Twitter) link must be a valid URL.",
            "instagram_link.url" => "Instagram link must be a valid URL.",
            "linkedin_link.url" => "LinkedIn link must be a valid URL.",

            "status.required" => "Status is required.",
            "status.in" => "Status must be either Active or Inactive.",
        ];
    }
}
