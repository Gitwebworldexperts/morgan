<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banners extends Model
{
    use HasFactory;
     protected $fillable = [
        'image_url',
        'link',
        'page_id',
        'property_id',
    ];
}
