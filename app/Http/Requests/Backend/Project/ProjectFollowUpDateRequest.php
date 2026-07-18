<?php

namespace App\Http\Requests\Backend\Project;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProjectFollowUpDateRequest extends FormRequest
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
                Rule::exists('projects', 'id'),
            ],
            "followup_date" => [
                "required",
                "date",
                "after_or_equal:today",
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'project_id.required' => 'The project ID is required.',
            'project_id.numeric' => 'The project ID must be a number.',
            'project_id.exists' => 'The selected project does not exist in our records.',
            'followup_date.required' => 'Please provide a follow-up date.',
            'followup_date.date' => 'The follow-up date must be a valid date.',
            'followup_date.after_or_equal' => 'The follow-up date cannot be in the past.',
        ];
    }
}
