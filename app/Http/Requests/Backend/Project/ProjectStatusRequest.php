<?php

namespace App\Http\Requests\Backend\Project;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProjectStatusRequest extends FormRequest
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
            "name" => [
                "required",
                Rule::unique('project_statuses')->ignore($id)
            ],
            "color" => ["nullable"],
            "status" => [
                "required",
                Rule::in(["Active", "Inactive"])
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The project status name is required.',
            'name.unique' => 'This project status name is already taken. Please use a different name.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The status must be either "Active" or "Inactive".',
        ];
    }

}
