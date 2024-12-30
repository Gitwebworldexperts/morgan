<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    // If your table name does not follow Laravel's naming conventions (plural form of the model name),
    // you can explicitly define the table name like so:
    protected $table = 'companies';

    // Define the fillable attributes for mass assignment protection
    protected $fillable = [
        'company_name', 
        'company_detail', 
        'track_record',
    ];

    protected $casts = [
        'track_record' => 'json',
    ];
}
