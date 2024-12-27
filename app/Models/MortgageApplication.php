<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MortgageApplication extends Model
{
    use HasFactory;

    // Define the table name (optional, if the table name is the plural of the model)
    protected $table = 'mortgage_applications';

    // Define the columns that are mass assignable
    protected $fillable = [
        'property_price',
        'down_payment',
        'loan_duration',
        'interest_rate',
        'email',
        'user_id',
        'monthely_payment'
    ];

    // Optionally, you can define any casts for specific data types
    protected $casts = [
        'property_price' => 'decimal:2',
        'down_payment' => 'decimal:2',
        'interest_rate' => 'decimal:2',
    ];
}
