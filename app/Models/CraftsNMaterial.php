<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CraftsNMaterial extends Model
{
    use HasFactory;

    protected $table = 'crafts_n_materials';

    protected $fillable = [
        'project_id',
        'img',
        'title',
        'description',
    ];

    /**
     * Get the project that owns this craft or material.
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
