<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoPage extends Model
{
    use HasFactory;

    protected $table = 'seo_pages';

    protected $fillable = [
        'page_id',
        'title',
        'description',
        'indexing',
        'canonical',
    ];

    /**
     * Get the related Page.
     */
    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }
}
