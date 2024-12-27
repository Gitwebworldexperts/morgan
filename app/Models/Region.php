<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    // If your table name is not the plural form of the model
    // protected $table = 'regions';

    // Define the columns that are mass assignable
    protected $fillable = ['name', 'description', 'image_url'];
}
