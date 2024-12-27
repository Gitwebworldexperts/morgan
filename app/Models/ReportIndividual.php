<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportIndividual extends Model
{
    use HasFactory;

    protected $fillable = [
        'heading', 'slug','subheading', 'file_upload', 'background_image', 'description',
        'section2_heading', 'section2_content',
        'section3_heading', 'testimonial_description','html_code','featured_image',
        'meta_title', 'meta_description', 'seo_heading', 'seo_description','section_ii_background_image'
    ];
    
    protected $casts = [
        'section2_content' => 'array',
    ];

    public function testimonials()
    {
        return $this->belongsToMany(Testimonial::class, 'report_testimonial', 'report_id', 'testimonial_id');
    }
    
}
