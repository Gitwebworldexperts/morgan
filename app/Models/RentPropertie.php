<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentPropertie extends Model
{
    use HasFactory;
       protected $fillable = [
        'name',
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

    public function banners()
    {
        return $this->hasMany(Banners::class, 'property_id'); // Specify the foreign key
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
