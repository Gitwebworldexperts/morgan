<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempBuyPropertie extends Model
{
    use HasFactory;
     protected $fillable = [
        'name',
        'slug',
        'agent',
        'description',
        'floor_plan',
        'brochure',
        'information_heading',
        'information_description',
        'information_button_label',
        'information_button_url',
        'address',
        'google_maps_link',
        'featured_image',
        'area',
        'jacuzzi',
        'bed',
        'price',
        'sale_price',
        'is_featured',
        'is_private',
        'country_id',
        'category_id',
        'description',
        'type',
        'tag',
        'status',
        'reference_number',
        'geopoints',
        'XML',
        'iframe'
    ];


}
