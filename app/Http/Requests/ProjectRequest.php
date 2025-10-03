<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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

            'title' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'status' => 'required|string|in:completed,ongoing',

            'video_thumbnail_img' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:40480',
            'video' => 'nullable|mimetypes:video/mp4,video/avi,video/mpeg,video/quicktime|max:102400',

            'overview' => 'nullable|string',

            'brochure' => $isUpdate
                ? 'nullable|file|mimes:pdf|max:40480'
                : 'required|file|mimes:pdf|max:40480',

            'total_area' => 'nullable|string|max:255',
            'open_space' => 'nullable|string|max:255',
            'polo_field_n_stable_expanse' => 'nullable|string|max:255',
            'clubhouse_gfa' => 'nullable|string|max:255',
            'mix_use_gfa' => 'nullable|string|max:255',
            'residential_cluster' => 'nullable|string|max:255',
            'resident_population' => 'nullable|string|max:255',
            'residences' => 'nullable|string|max:255',

            'reception_img' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:40480',
            'exterior_img' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:40480',
            'interior_img' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:40480',
            'section_one_img' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:40480',

            'amenities_brochure' => 'nullable|file|mimes:pdf|max:40480',

            'location_overview' => 'nullable|string',
            'location_map_url' => 'nullable|url|max:255',

            'near_by_entertainment' => 'nullable|array',
            'near_by_entertainment.*.key' => 'nullable|string|max:255',
            'near_by_entertainment.*.value' => 'nullable|string|max:255',

            'near_by_schools' => 'nullable|array',
            'near_by_schools.*.key' => 'nullable|string|max:255',
            'near_by_schools.*.value' => 'nullable|string|max:255',

            'near_by_clinics' => 'nullable|array',
            'near_by_clinics.*.key' => 'nullable|string|max:255',
            'near_by_clinics.*.value' => 'nullable|string|max:255',

            'map_iframe' => 'nullable|string',

            'section_two_img' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:40480',

            'trademark_interior_img' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:40480',
            'trademark_interior_description' => 'nullable|string',
            'trademark_interior_brochure' => 'nullable|file|mimes:pdf|max:40480',

            'section_three_img' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:40480',

            'construction_update_img' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:40480',
            'construction_update_date' => 'nullable|date',

            'construction_plan' => 'nullable|file|mimes:pdf|max:40480',
        ];
    }

    public function attributes(): array
    {
        return [
            'thumbnail_img' => 'thumbnail image',
            'video_thumbnail_img' => 'video thumbnail image',
            'video' => 'video link',
            'overview' => 'project overview',
            'brochure' => 'project brochure',
            'total_area' => 'total area',
            'open_space' => 'open space',
            'polo_field_n_stable_expanse' => 'polo field & stable expanse',
            'clubhouse_gfa' => 'clubhouse GFA',
            'mix_use_gfa' => 'mixed use GFA',
            'residential_cluster' => 'residential cluster',
            'resident_population' => 'resident population',
            'residences' => 'residences',
            'reception_img' => 'reception image',
            'exterior_img' => 'exterior image',
            'interior_img' => 'interior image',
            'section_one_img' => 'section one image',
            'amenities_brochure' => 'amenities brochure',
            'location_overview' => 'location overview',
            'location_map_url' => 'location map URL',
            'near_by_entertainment' => 'nearby entertainment',
            'near_by_schools' => 'nearby schools',
            'near_by_clinics' => 'nearby clinics',
            'map_iframe' => 'map iframe',
            'section_two_img' => 'section two image',
            'trademark_interior_img' => 'trademark interior image',
            'trademark_interior_description' => 'trademark interior description',
            'trademark_interior_brochure' => 'trademark interior brochure',
            'section_three_img' => 'section three image',
            'construction_update_img' => 'construction update image',
            'construction_update_date' => 'construction update date',
            'construction_plan' => 'construction plan',
        ];
    }
}
