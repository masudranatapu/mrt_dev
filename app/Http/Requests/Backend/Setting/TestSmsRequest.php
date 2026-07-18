<?php

namespace App\Http\Requests\Backend\Setting;

use Illuminate\Foundation\Http\FormRequest;

class TestSmsRequest extends FormRequest
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
            'phone_numbers' => [
                'required',
                'string',
                'regex:/^([\d\s\-\+\(\)]+)(,\s*[\d\s\-\+\(\)]+)*$/'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'phone_numbers.required' => 'At least one phone number is required.',
            'phone_numbers.string' => 'Phone numbers must be provided as a valid string.',
            'phone_numbers.regex' => 'Phone numbers must be separated by commas and may only contain digits, spaces, dashes, plus signs, and parentheses.',
        ];
    }
}
