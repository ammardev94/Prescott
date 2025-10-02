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
            'img' => $isUpdate
                ? ['nullable', new ValidImageOrName]
                : 'required|image|mimes:jpeg,png,jpg,gif|max:10240',

            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'author_name' => 'nullable|string|max:255',

            'author_img' => $isUpdate
                ? ['nullable', new ValidImageOrName]
                : 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',

            'author_youtube' => 'nullable|url|max:255',
            'author_facebook' => 'nullable|url|max:255',
            'author_linkdin' => 'nullable|url|max:255',
        ];
    }

    /**
     * Get custom attribute names for validation errors.
     */
    public function attributes(): array
    {
        return [
            'img' => 'news image',
            'author_img' => 'author image',
            'author_youtube' => 'author YouTube link',
            'author_facebook' => 'author Facebook link',
            'author_linkdin' => 'author LinkedIn link',
        ];
    }
}
