<?php

namespace App\Http\Requests\Backend\Profile;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AdminProfileUpdateRequest extends FormRequest
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
        $id = authAdmin()->id;

        return [
            "designation_id" => [
                "required",
                Rule::exists('designations', 'id')
            ],
            "department_id" => [
                "required",
                Rule::exists('departments', 'id')
            ],
            "first_name" => [
                "required",
                "string",
                "max:50"
            ],
            "last_name" => [
                "required",
                "string",
                "max:50"
            ],
            "username" => [
                "required",
                "string",
                "max:50",
                Rule::unique('users')->ignore($id)
            ],
            "present_address" => [
                "required",
                "string"
            ],
            "permanent_address" => [
                "nullable",
                "string"
            ],
            "avatar" => [
                "nullable",
                'mimes:png,jpg,jpeg,webp,svg,pdf',
                'max:5120'
            ],
            "nid_no" => [
                "nullable",
                "numeric",
                "min:10",
                "max:20"
            ],
            "nid" => [
                "nullable",
                'mimes:png,jpg,jpeg,webp,svg,pdf',
                'max:5120'
            ],
            "country" => [
                "nullable",
                "string",
                "max:50"
            ],
            "emergency_contact_person_name" => [
                "nullable",
                "string",
                "max:50"
            ],
            "emergency_contact_person_address" => [
                "nullable",
                "string"
            ],
            "emergency_contact" => [
                "nullable",
                Rule::unique('users')->ignore($id)
            ],
            "language" => [
                "nullable",
                "array",
                "min:1"
            ],
            "language.*" => ["string"],
            "signature" => [
                "nullable",
                'mimes:png,jpg,jpeg,webp,svg,pdf',
                'max:5120'
            ],
            "gender" => [
                "nullable",
                Rule::in(["Male", "Female", "Other"])
            ],
            "date_of_birth" => [
                "nullable",
                "date"
            ],
            "bio" => [
                "nullable",
                "string"
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'designation_id.required' => 'The designation field is required.',
            'designation_id.exists'   => 'The selected designation is invalid.',
            'department_id.required' => 'The department field is required.',
            'department_id.exists'   => 'The selected department is invalid.',
            // Name
            'first_name.required' => 'First name is required.',
            'first_name.string'   => 'First name must be a valid string.',
            'first_name.max'      => 'First name may not be greater than 50 characters.',
            'last_name.required' => 'Last name is required.',
            'last_name.string'   => 'Last name must be a valid string.',
            'last_name.max'      => 'Last name may not be greater than 50 characters.',
            // Username
            'username.required' => 'Username is required.',
            'username.string'   => 'Username must be a valid string.',
            'username.max'      => 'Username may not be greater than 50 characters.',
            'username.unique'   => 'This username is already taken.',
            // Address
            'present_address.required' => 'Present address is required.',
            'present_address.string'   => 'Present address must be a valid string.',
            'permanent_address.string' => 'Permanent address must be a valid string.',
            // Avatar
            'avatar.mimes' => 'Avatar must be an image or PDF (png, jpg, jpeg, webp, svg, pdf).',
            'avatar.max'   => 'Avatar size must not exceed 5 MB.',
            // NID
            'nid.mimes' => 'NID file must be an image or PDF (png, jpg, jpeg, webp, svg, pdf).',
            'nid.max'   => 'NID file size must not exceed 5 MB.',
            'nid_no.numeric' => 'NID number must be numeric.',
            'nid_no.min'     => 'NID number must be at least 10 digits.',
            'nid_no.max'     => 'NID number may not exceed 20 digits.',
            // Country
            'country.string' => 'Country name must be a valid string.',
            'country.max'    => 'Country name may not be greater than 50 characters.',
            // Emergency Contact
            'emergency_contact_person_name.string' => 'Emergency contact person name must be a valid string.',
            'emergency_contact_person_name.max'    => 'Emergency contact person name may not be greater than 50 characters.',
            'emergency_contact_person_address.string' => 'Emergency contact person address must be a valid string.',
            'emergency_contact.unique' => 'This emergency contact number is already in use.',
            // Language
            'language.array' => 'Language must be selected as an array.',
            'language.min'   => 'Please select at least one language.',
            'language.*.string' => 'Each language value must be a valid string.',
            // Signature
            'signature.mimes' => 'Signature must be an image or PDF (png, jpg, jpeg, webp, svg, pdf).',
            'signature.max'   => 'Signature size must not exceed 5 MB.',
            // Gender
            'gender.in' => 'Gender must be Male, Female, or Other.',
            // Date of Birth
            'date_of_birth.date' => 'Date of birth must be a valid date.',
            // Bio
            'bio.string' => 'Bio must be a valid string.',
        ];
    }
}
