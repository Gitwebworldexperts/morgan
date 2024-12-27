<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'related_post_id','images','slug','related_posts','meta_title','meta_description'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function relatedPost()
    {
        return $this->belongsTo(Post::class, 'related_post_id');
    }
}
