<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerPage extends Model
{
    use HasFactory;

    protected $fillable = ['heading', 'description', 'button_link', 'section2_heading', 'video_path'];

    public function images()
    {
        return $this->hasMany(CareerImage::class);
    }
}
