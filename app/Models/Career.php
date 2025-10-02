<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $table = 'careers';

    protected $fillable = [
        'full_name',
        'email',
        'position',
        'education_level',
        'reason_to_join',
        'cover_letter',
        'resume',
        'is_agree',
    ];

    protected $casts = [
        'is_agree' => 'boolean',
    ];
}
