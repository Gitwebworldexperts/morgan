<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeaderSections extends Model
{
    use HasFactory;
    
    protected $fillable = ['logo_url', 'navigation_links'];

    protected $casts = [
        'navigation_links' => 'array',
    ];
}
