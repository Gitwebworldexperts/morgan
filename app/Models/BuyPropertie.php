<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyPropertie extends Model
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

    public function country()
    {
        return $this->belongsTo(Countries::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }


    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class, 'category_id');
    }



    public function community()
    {
        return $this->belongsTo(Community::class, 'community_id');
    }

    public function banners()
    {
        return $this->hasMany(Banners::class, 'property_id')->where('page_type', 'buy'); // Specify the foreign key
    }

    public static function getFeaturedProperties()
    {
        return self::where('is_featured', 1)
                   ->active() // Use the scope
                   ->get();
    }

    public static function getPrivateProperties($limit = 10, $orderBy = 'created_at', $direction = 'asc')
    {
        return self::where('is_private', 1)
                   ->active() // Use the scope
                   ->orderBy($orderBy, $direction)
                   ->limit($limit)
                   ->get();
    }
}
