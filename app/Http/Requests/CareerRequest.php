<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CareerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        $isUpdate = in_array($this->method(), ['PUT', 'PATCH']);

        return [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'position' => 'required|string|max:255',
            'education_level' => 'nullable|string|max:255',
            'reason_to_join' => 'nullable|string',
            'cover_letter' => $isUpdate
                ? 'nullable|mimes:pdf,doc,docx|max:2048'
                : 'required|mimes:pdf,doc,docx|max:2048',
            'resume' => $isUpdate
                ? 'nullable|mimes:pdf,doc,docx|max:2048'
                : 'required|mimes:pdf,doc,docx|max:2048',
            
            'is_agree' => 'required|boolean',
        ];
    }

    public function attributes(): array
    {
        return [
            'full_name' => 'full name',
            'email' => 'email address',
            'position' => 'position applied',
            'education_level' => 'education level',
            'reason_to_join' => 'reason to join',
            'cover_letter' => 'cover letter',
            'resume' => 'resume file',
            'is_agree' => 'terms & conditions agreement',
        ];
    }
}
