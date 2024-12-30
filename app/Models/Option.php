<?php

// app/Models/Option.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    // The table associated with the model.
    protected $table = 'options';

    // The attributes that are mass assignable.
    protected $fillable = ['option_name', 'option_value'];

    // Disable the auto-maintenance of timestamps if you don't need them.
    public $timestamps = true;

    // Optionally, you can cast the option_value to an array if it's serialized.
    protected $casts = [
        'option_value' => 'array',  // Auto-unserialize when accessing
    ];
}
