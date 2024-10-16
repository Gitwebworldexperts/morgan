<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class community_detail extends Model
{
    use HasFactory;
    protected $fillable = [
                    "heading",
                    "bg_image",
                    "second_section",
                    "insights",
                    "featured_property"
                ];
}