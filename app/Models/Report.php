<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'background',
        'content',
        'read_more',
        'section1_heading',
        'section1_image_1', 'section1_content_1', 'section1_title_1',
        'section1_image_2', 'section1_content_2', 'section1_title_2',
        'section1_image_3', 'section1_content_3', 'section1_title_3',
        'section2_title',
        'section2_image_1', 'section2_image_2', 'section2_image_3', 
        'section2_image_4', 'section2_image_5', 'section2_image_6',
        'section2_title_1', 'section2_title_2', 'section2_title_3', 
        'section2_title_4', 'section2_title_5', 'section2_title_6',
    ];
}
