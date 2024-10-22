<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListWithUs extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'full_name',
        'email',
        'contact_number',
        'property_type',
        'bedrooms',
        'area',
        'building_name',
    ];
}
