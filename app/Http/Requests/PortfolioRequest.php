<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PortfolioRequest extends FormRequest
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
                ? 'nullable|image|mimes:jpeg,png,jpg,webp|max:40480'
                : 'required|image|mimes:jpeg,png,jpg,webp|max:40480',

            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:40480',

            'title' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'map' => 'nullable|string',
            'map_url' => 'nullable|url|max:255',
            'client' => 'nullable|string|max:255',
            'value' => 'nullable|string|max:255',
            'consortium' => 'nullable|string|max:255',
            'tanama_role' => 'nullable|string|max:255',
            'builder' => 'nullable|string|max:255',
            'architect' => 'nullable|string|max:255',
            'financial_close_date' => 'nullable|string|max:255',
            'completion_date' => 'nullable|string|max:255',
            'contract_terms' => 'nullable|string|max:255',
            'awards' => 'nullable|string|max:255',
            'other_information' => 'nullable|string|max:500',
            'status' => 'string|in:in-progress,completed',
            'section_one_title' => 'nullable|string|max:255',
            'section_one_paragraph' => 'nullable|string',
            'section_one_button_text' => 'nullable|string|max:255',
            'section_one_button_file' => $isUpdate
                ? 'nullable|file|mimes:pdf,docx|max:40480'
                : 'required|file|mimes:pdf,docx|max:40480',
            'section_four_title' => 'nullable|string|max:255',
            'section_four_paragraph' => 'nullable|string',
            'section_four_button_text' => 'nullable|string|max:255',
            'section_four_button_link' => 'nullable|url|max:255',
        ];
    }

    public function attributes(): array
    {
        return [
            'thumbnail_img' => 'thumbnail image',
            'images' => 'portfolio images',
            'section_one_title' => 'section one title',
            'section_one_paragraph' => 'section one paragraph',
            'section_one_button_text' => 'section one button text',
            'section_one_button_file' => 'section one button file',
            'section_four_title' => 'section four title',
            'section_four_paragraph' => 'section four paragraph',
            'section_four_button_text' => 'section four button text',
            'section_four_button_link' => 'section four button link',
        ];
    }
}