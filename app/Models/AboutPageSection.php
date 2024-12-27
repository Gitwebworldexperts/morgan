<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutPageSection extends Model
{
    use HasFactory;

    protected $fillable = ['about_page_id', 'heading', 'description', 'image'];

    public function aboutPage()
    {
        return $this->belongsTo(AboutPage::class);
    }
}
