<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    use HasFactory;
    protected $fillable = ['type_name', 'property', 'status'];

     public function properties()
    {
        return $this->hasMany(Properties::class, 'category_id');
    }
}
