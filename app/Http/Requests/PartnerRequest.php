<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartnerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->guard('admin')->check();
    }

    public function rules(): array
    {
        $isUpdate = in_array($this->method(), ['PUT', 'PATCH']);

        return [
            'thumbnail_img' => $isUpdate
                ? ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:20480']
                : 'required|image|mimes:jpeg,png,jpg,webp|max:20480',

            'logo' => $isUpdate
                ? ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:20480']
                : 'required|image|mimes:jpeg,png,jpg,webp|max:20480',

            'name' => 'required|string|max:255',
        ];
    }

    public function attributes(): array
    {
        return [
            'thumbnail_img' => 'partner thumbnail image',
            'logo' => 'partner logo',
            'name' => 'partner name',
        ];
    }
}
