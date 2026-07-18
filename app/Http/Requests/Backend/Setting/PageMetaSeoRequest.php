<?php

namespace App\Http\Requests\Backend\Setting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PageMetaSeoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "page_type" => [
                "required",
                Rule::in([
                    "home",
                    "about",
                    "contact",
                    "blog",
                    "privacy",
                    "terms",
                    "faq",
                    "career",
                    "common"
                ])
            ],
            // pages meta
            "*.description" => ["nullable", "string", "max:300"],
            "*.keywords" => ["nullable", "string"],
            "*.robots" => ["nullable", "string"],
            "*.canonical_url" => ["nullable", "string"],
            // common meta
            "author" => ["nullable", "string"],
            "og_title" => ["nullable", "string"],
            "og_description" => ["nullable", "string"],
            "og_type" => ["nullable", "string"],
            "og_url" => ["nullable", "url"],
            "og_site_name" => ["nullable", "string"],

            "twitter_card" => ["nullable", "string"],
            "twitter_title" => ["nullable", "string"],
            "twitter_description" => ["nullable", "string"],

            "og_image" => ["nullable", "image", "mimes:jpg,jpeg,png,webp", "max:5120"],
            "twitter_image" => ["nullable", "image", "mimes:jpg,jpeg,png,webp", "max:5120"],
        ];
    }

    public function messages(): array
    {
        return [
            'page_type.required' => 'Page type is required.',
            'page_type.in' => 'Invalid page type selected.',

            '*.string' => 'The :attribute must be a valid text.',
            '*.max' => 'The :attribute may not exceed :max characters.',
            '*.url' => 'The :attribute must be a valid URL.',

            'og_image.image' => 'OG image must be an image file.',
            'og_image.mimes' => 'OG image must be JPG, PNG, or WEBP.',
            'og_image.max' => 'OG image size must be less than 5MB.',

            'twitter_image.image' => 'Twitter image must be an image file.',
            'twitter_image.mimes' => 'Twitter image must be JPG, PNG, or WEBP.',
            'twitter_image.max' => 'Twitter image size must be less than 5MB.',
        ];
    }

    public function attributes(): array
    {
        return [
            'home_description' => 'Home Description',
            'about_description' => 'About Description',
            'contact_description' => 'Contact Description',
            'blog_description' => 'Blog Description',
            'privacy_description' => 'Privacy Description',
            'terms_description' => 'Terms Description',
            'faq_description' => 'FAQ Description',
            'career_description' => 'Career Description',

            'home_keywords' => 'Home Keywords',
            'about_keywords' => 'About Keywords',
            'contact_keywords' => 'Contact Keywords',
            'blog_keywords' => 'Blog Keywords',
            'privacy_keywords' => 'Privacy Keywords',
            'terms_keywords' => 'Terms Keywords',
            'faq_keywords' => 'FAQ Keywords',
            'career_keywords' => 'Career Keywords',

            'og_title' => 'Open Graph Title',
            'og_description' => 'Open Graph Description',
            'og_image' => 'Open Graph Image',

            'twitter_title' => 'Twitter Title',
            'twitter_description' => 'Twitter Description',
            'twitter_image' => 'Twitter Image',
        ];
    }
}
