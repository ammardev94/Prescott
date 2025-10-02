<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'title',
        'description',
        'type',
        'is_featured',
        'img',
        'paragraph_one_title',
        'paragraph_one_description',
        'paragraph_one_img',
        'paragraph_two_title',
        'paragraph_two_description',
        'paragraph_two_img',
        'paragraph_three_title',
        'paragraph_three_description',
        'paragraph_three_img',
        'youtube_url',
        'twitter_url',
        'facebook_url',
        'linkdin_url',
    ];
}
