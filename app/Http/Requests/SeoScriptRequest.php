<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeoScriptRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'header' => 'nullable|string',
            'body'   => 'nullable|string',
            'footer' => 'nullable|string',
        ];
    }

    /**
     * Get custom attribute names for validation errors.
     */
    public function attributes(): array
    {
        return [
            'header' => 'header script',
            'body'   => 'body script',
            'footer' => 'footer script',
        ];
    }
}
