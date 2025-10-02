<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidImageOrName;

class NewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->guard('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $isUpdate = in_array($this->method(), ['PUT', 'PATCH']);

        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'nullable|in:events,launches',
            'is_featured' => 'nullable|boolean',

            'img' => $isUpdate
                ? ['nullable', new ValidImageOrName]
                : 'required|image|mimes:jpeg,png,jpg,gif|max:10240',

            'paragraph_one_title' => 'nullable|string|max:255',
            'paragraph_one_description' => 'nullable|string',
            'paragraph_one_img' => $isUpdate
                ? ['nullable', new ValidImageOrName]
                : 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',

            'paragraph_two_title' => 'nullable|string|max:255',
            'paragraph_two_description' => 'nullable|string',
            'paragraph_two_img' => $isUpdate
                ? ['nullable', new ValidImageOrName]
                : 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',

            'paragraph_three_title' => 'nullable|string|max:255',
            'paragraph_three_description' => 'nullable|string',
            'paragraph_three_img' => $isUpdate
                ? ['nullable', new ValidImageOrName]
                : 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',

            'youtube_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'linkdin_url' => 'nullable|url|max:255',
        ];
    }

    /**
     * Get custom attribute names for validation errors.
     */
    public function attributes(): array
    {
        return [
            'img' => 'main news image',
            'paragraph_one_img' => 'paragraph one image',
            'paragraph_two_img' => 'paragraph two image',
            'paragraph_three_img' => 'paragraph three image',
            'youtube_url' => 'YouTube link',
            'twitter_url' => 'Twitter link',
            'facebook_url' => 'Facebook link',
            'linkdin_url' => 'LinkedIn link',
        ];
    }
}
