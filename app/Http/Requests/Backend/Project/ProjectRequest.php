<?php

namespace App\Http\Requests\Backend\Project;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            "client_id" => [
                "nullable",
                "numeric",
                Rule::exists('clients', 'id')
            ],
            "project_status_id" => [
                "required",
                "numeric",
                Rule::exists('project_statuses', 'id')
            ],
            "name" => [
                "required",
                Rule::unique('projects')->ignore($id)
            ],
            "description" => ["required", "string", "min:3"],
            "project_document" => [
                "nullable",
                'mimes:pdf',
                'max:10240'
            ],
            "project_thumbnail" => [
                $id ? "nullable" : "required",
                'mimes:png,jpg,jpeg,webp,svg',
                'max:5120'
            ],
            "start_date" => ["required", "date"],
            "end_date" => ["required", "date", "after_or_equal:start_date"],
            "followup_date" => ["nullable", "date"],
            "technology" => ["nullable"],
            "technology.*" => ["string"],
            "key_features" => ["nullable"],
            "key_features.*" => ["string"],
            "tags" => ["nullable"],
            "tags.*" => ["string"],
            "assignee_ids" => ["nullable", "array"],
            "assignee_ids.*" => [
                "numeric",
                Rule::exists('users', 'id')
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
            'client_id.numeric' => 'The client ID must be a number.',
            'client_id.exists' => 'The selected client does not exist.',

            'project_status_id.required' => 'The project status field is required.',
            'project_status_id.numeric' => 'The project status ID must be a number.',
            'project_status_id.exists' => 'The selected project status does not exist.',

            'name.required' => 'The project name is required.',
            'name.unique' => 'This project name has already been taken.',

            'description.required' => 'The project description is required.',
            'description.string' => 'The project description must be a string.',
            'description.min' => 'The project description must be at least :min characters.',

            'project_thumbnail.required' => 'Project thumbnail is required.',
            'project_thumbnail.mimes' => 'Project thumbnail must be a file of type: png, jpg, jpeg, webp, svg.',
            'project_thumbnail.max' => 'Project thumbnail size must not exceed 5 MB.',

            'project_document.mimes' => 'The project document must be a PDF file.',
            'project_document.max' => 'The project document size must not exceed 10 MB.',

            'start_date.required' => 'The project start date is required.',
            'start_date.date' => 'The start date must be a valid date.',

            'end_date.required' => 'The project end date is required.',
            'end_date.date' => 'The end date must be a valid date.',
            'end_date.after_or_equal' => 'The end date cannot be earlier than the start date.',

            'assignee_ids.array' => 'The assignees must be an array.',
            'assignee_ids.*.numeric' => 'Each assignee ID must be a number.',
            'assignee_ids.*.exists' => 'One or more selected assignees do not exist.',

            'status.required' => 'The status field is required.',
            'status.in' => 'The status must be either Active or Inactive.',
        ];
    }
}
