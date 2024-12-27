<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    // Define the table associated with the model (optional if the table name matches the pluralized model name)
    protected $table = 'files';

    // Specify which attributes are mass assignable
    protected $fillable = [
        'name',      // The original file name
        'file_path', // The file path in the storage
    ];

    // Optionally, you can define the attributes that should be hidden from arrays or JSON output
    protected $hidden = [];

    // Define the timestamps for the created_at and updated_at columns (if applicable)
    public $timestamps = true;
}
