<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    // Define the table associated with the model (optional if follows Laravel's naming convention)
    protected $table = 'careers';

    // Define the fillable attributes to prevent mass-assignment vulnerabilities
    protected $fillable = [
        'job_name',
        'job_type',
        'job_location',
        'position',
        'description',
        'responsibilities',
        'status', // e.g. 'open', 'closed', 'pending'
    ];

    // Optionally, you can define the dates for created_at and updated_at, if necessary
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Optionally, you can add any custom methods or relationships for the model.
     * For example, if you have a relationship with another model, you could define it here.
     */

    // Example: If you had a relationship with a User model
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

}
