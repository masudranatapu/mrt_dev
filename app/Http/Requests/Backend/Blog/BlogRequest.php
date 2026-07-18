<?php

namespace App\Http\Requests\Backend\Blog;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogRequest extends FormRequest
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
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('blogs', 'title')->ignore($id),
            ],
            'description' => ['required', 'string'],
            "thumbnail" => [
                $id ? "nullable" : "required",
                'mimes:png,jpg,jpeg,webp,svg',
                'max:5120'
            ],
            'status' => [
                'required',
                'string',
                Rule::in(['Active', 'Inactive']),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The blog title is required.',
            'title.string' => 'The blog title must be valid text.',
            'title.max' => 'The blog title may not be greater than 255 characters.',
            'title.unique' => 'This blog title already exists. Please choose another one.',

            'description.required' => 'The blog description is required.',
            'description.string' => 'The blog description must be valid text.',

            'thumbnail.required' => 'Please upload a blog thumbnail image.',
            'thumbnail.mimes' => 'Thumbnail must be a file of type: png, jpg, jpeg, webp, svg.',
            'thumbnail.max' => 'Thumbnail size must not exceed 5MB.',

            'status.required' => 'Blog status is required.',
            'status.string' => 'Invalid status format.',
            'status.in' => 'Status must be either Active or Inactive.',
        ];
    }
}
