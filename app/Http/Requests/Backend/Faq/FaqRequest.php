<?php

namespace App\Http\Requests\Backend\Faq;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FaqRequest extends FormRequest
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
            "question" => [
                "required",
                "string",
                "max:255"
            ],
            "answer" => [
                "nullable",
                "string"
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
            'question.required' => 'The question is required.',
            'question.string' => 'The question must be valid text.',
            'question.max' => 'The question may not be greater than 255 characters.',

            'status.required' => 'Status is required.',
            'status.in' => 'Status must be either Active or Inactive.',
        ];
    }
}
