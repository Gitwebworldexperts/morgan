<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageBrandedResidence extends Model
{
    // The table associated with the model
    protected $table = 'page_branded_residences';

    // The attributes that are mass assignable
    protected $fillable = [
        'title',
        'description',
        'image',
        'link',
        'heading_1',
        'image_1',
        'description_1',
        'image_2',
        'description_2',
        'heading_3',
        'images_3',
        'headings_3',
        'title_4',
        'description_4',
        'image_4',
        'link_4',
    ];

    // The attributes that should be cast to native types
    protected $casts = [
        'images_3' => 'array',  // Automatically cast JSON column to array
        'headings_3' => 'array', // Automatically cast JSON column to array
    ];
}
