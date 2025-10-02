<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
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
        $id = $this->route('team');

        return [
            'name'       => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'img'        => $this->isMethod('post')
                ? 'required|image|mimes:jpeg,png,jpg,webp|max:20480'
                : 'nullable|image|mimes:jpeg,png,jpg,webp|max:20480',
        ];
    }
}
