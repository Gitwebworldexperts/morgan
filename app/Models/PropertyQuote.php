<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyQuote extends Model
{
    use HasFactory;

    protected $table = 'property_quote';

    protected $fillable = [
        'full_name',
        'email',
        'property_location',
        'message',
    ];
}
