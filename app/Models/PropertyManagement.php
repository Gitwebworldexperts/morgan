<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyManagement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'section_1_title',
        'section_1_description',
        'section_1_anchor_link',
        'section_1_image',
        'section_2_title',
        'section_2_description',
        'section_2_anchor_link','get_an_quote_image',
        'blog'
    ];
}
