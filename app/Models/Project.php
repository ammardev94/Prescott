<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'thumbnail_img',
        'title',
        'location',
        'status',
        'video_thumbnail_img',
        'video',
        'overview',
        'brochure',
        'total_area',
        'open_space',
        'polo_field_n_stable_expanse',
        'clubhouse_gfa',
        'mix_use_gfa',
        'residential_cluster',
        'resident_population',
        'residences',
        'reception_img',
        'exterior_img',
        'interior_img',
        'section_one_img',
        'amenities_brochure',
        'location_overview',
        'location_map_url',
        'near_by_entertainment',
        'near_by_schools',
        'near_by_clinics',
        'map_iframe',
        'section_two_img',
        'trademark_interior_img',
        'trademark_interior_description',
        'trademark_interior_brochure',
        'section_three_img',
        'construction_update_img',
        'construction_update_date',
        'construction_plan',
    ];

    protected $casts = [
        'near_by_entertainment' => 'array',
        'near_by_schools'       => 'array',
        'near_by_clinics'       => 'array',
        'construction_update_date' => 'date',
    ];

    public function amenities(): HasMany
    {
        return $this->hasMany(Amenity::class);
    }

    public function craftsNMaterials(): HasMany
    {
        return $this->hasMany(CraftsNMaterial::class);
    }


}
