<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterSections extends Model
{
    use HasFactory;

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'logo_url',
        'address',
        'email',
        'phone',
        'navigation_menus',
        'newsletter_section',
        'social_media_links',
        'copyright',
    ];

    // Specify the attributes that should be cast to native types
    protected $casts = [
        'navigation_menus' => 'array',
        'social_media_links' => 'array',
    ];
}
