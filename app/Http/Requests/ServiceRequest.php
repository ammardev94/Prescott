<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
     */
    public function rules(): array
    {
        $isUpdate = in_array($this->method(), ['PUT', 'PATCH']);

        return [
            'img' => $isUpdate
                ? 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240'
                : 'required|image|mimes:jpeg,png,jpg,gif|max:10240',

            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'link' => 'nullable|url|max:255',
        ];
    }

    /**
     * Get custom attribute names for validation errors.
     */
    public function attributes(): array
    {
        return [
            'img' => 'service image',
            'title' => 'service title',
            'description' => 'service description',
            'link' => 'service link',
        ];
    }
}
