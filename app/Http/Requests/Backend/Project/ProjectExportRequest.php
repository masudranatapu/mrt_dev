<?php

namespace App\Http\Requests\Backend\Project;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProjectExportRequest extends FormRequest
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
            'type' => [
                'required',
                Rule::in(["csv", "xlsx"]),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => 'The type is required.',
            'type.in' => 'The type must be one of the following: csv, xlsx.',
        ];
    }
}
