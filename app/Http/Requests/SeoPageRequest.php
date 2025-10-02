<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeoPageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->guard('admin')->check();
    }

    public function rules(): array
    {
        return [
            'page_id'     => 'required|exists:pages,id',
            'title'       => 'required|string|min:3|max:255',
            'description' => 'nullable|string',
            'indexing'    => 'required|in:nofollow_noindex,follow_index',
            'canonical'   => 'nullable|url|max:255',
        ];
    }

    public function attributes(): array
    {
        return [
            'page_id'     => 'page',
            'title'       => 'title',
            'description' => 'description',
            'indexing'    => 'indexing type',
            'canonical'   => 'canonical URL',
        ];
    }
}
