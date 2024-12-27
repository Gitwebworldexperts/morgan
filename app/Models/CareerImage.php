<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerImage extends Model
{
    use HasFactory;

    protected $fillable = ['career_page_id', 'image_path'];
}
