<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AmenityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->guard('admin')->check();
    }

    public function rules(): array
    {
        $isUpdate = in_array($this->method(), ['PUT', 'PATCH']);

        return [
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'img' => $isUpdate
                ? 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
                : 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }

    public function attributes(): array
    {
        return [
            'project_id' => 'project',
            'title' => 'amenity title',
            'img' => 'amenity image',
        ];
    }
}
