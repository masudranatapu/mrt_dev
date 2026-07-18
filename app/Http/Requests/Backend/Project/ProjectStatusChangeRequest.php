<?php

namespace App\Http\Requests\Backend\Project;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProjectStatusChangeRequest extends FormRequest
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
            "project_id" => [
                "required",
                "numeric",
                Rule::exists('projects', 'id')
            ],
            "project_status_id" => [
                "required",
                "numeric",
                Rule::exists('project_statuses', 'id')
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'project_id.required' => 'Project ID is required.',
            'project_id.numeric' => 'Project ID must be a numeric value.',
            'project_id.exists' => 'The selected Project ID does not exist.',

            'project_status_id.required' => 'Project Status ID is required.',
            'project_status_id.numeric' => 'Project Status ID must be a numeric value.',
            'project_status_id.exists' => 'The selected Project Status ID is invalid or does not exist.',
        ];
    }
}
