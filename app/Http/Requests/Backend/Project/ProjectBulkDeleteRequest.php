<?php

namespace App\Http\Requests\Backend\Project;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProjectBulkDeleteRequest extends FormRequest
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
            "bulk_ids" => [
                'required',
                "array",
                "min:1"
            ],
            "bulk_ids.*" => [
                Rule::exists('projects', 'id')
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'bulk_ids.required' => 'Please select at least one project.',
            'bulk_ids.array' => 'The selected project must be in a valid list.',
            'bulk_ids.min' => 'You must select at least one project.',
            'bulk_ids.*.exists' => 'One or more selected project are invalid or do not exist.',
        ];
    }
}
