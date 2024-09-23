<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    use HasFactory;
    protected $fillable = [
        'section_1',
        'first_section_image',
        'first_section_heading',
        'list_property',
        'section_2',
        'second_heading',
        'second_description',
        'second_section_button',
        'section_3',
        'toggle_featured_property',
        'third_section_button',
        'section_4',
        'fourth_heading',
        'toggle_private_property',
        'fourth_description',
        'fourth_section_button',
        'section_5',
        'fifth_heading',
        'toggle_international_property',
        'fifth_section_image',
        'fifth_section_button',
        'section_6',
        'sixth_heading',
        'toggle_development_property',
        'sixth_section_button',
        'section_7',
        'seventh_heading',
        'section_8',
        'eighth_heading',
        'eighth_description',
        'eighth_section_button',
        'section_9',
        'ninth_heading',
        'toggle_blog_list',
        'section_10',
        'tenth_heading',
        'tenth_description',
        'tenth_section_image',
        'tenth_section_button',
    ];

    // If you need to cast JSON or ENUM types
    protected $casts = [
        'second_section_button' => 'array',
        'third_section_button' => 'array',
        'fourth_section_button' => 'array',
        'fifth_section_button' => 'array',
        'sixth_section_button' => 'array',
        'eighth_section_button' => 'array',
        'tenth_section_button' => 'array',
    ];
}
