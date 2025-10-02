<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasFactory;

    protected $table = 'amenities';

    protected $fillable = [
        'project_id',
        'img',
        'title',
    ];

    /**
     * Get the project that owns the amenity.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
