<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageListWithUs extends Model
{
    use HasFactory;

    // Table name (optional if it matches the convention)
    protected $table = 'page_list_with_us';

    // Primary key (optional if it's 'id')
    protected $primaryKey = 'id';

    // Timestamps (optional, Laravel enables this by default)
    public $timestamps = true;

    // Define fillable fields for mass assignment (you can add the required fields here)
    protected $fillable = [
        'heading',
        'sub_heading',
        'anchor_link',
        'section_1_image',
        'section_2_image_1',
        'section_2_title_1',
        'section_2_subheading_1',
        'section_2_image_2',
        'section_2_title_2',
        'section_2_subheading_2',
        'section_2_image_3',
        'section_2_title_3',
        'section_2_subheading_3',
        'section_3_heading',
        'section_3_subheading',
        'section_3_anchor_link',
    ];

    // Optionally, you can add a `$guarded` property instead of `$fillable`
    // if you want to specify which fields are *not* mass-assignable.
    // protected $guarded = [];
}
