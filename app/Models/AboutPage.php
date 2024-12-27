<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'main_background','team_description'];

    public function sections()
    {
        return $this->hasMany(AboutPageSection::class);
    }
}
