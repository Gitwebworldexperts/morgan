<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;

    protected $fillable = [
        'community_name',
        'featured_image',
        'section_i_image',
        'section_i_content',
        'section_ii_content',
        'button_i_name',
        'button_ii_name',
        'button_i_url',
        'button_ii_url',
        'second_image',
        'section_iii_content',
        'section_iii_button_name',
        'status'
    ];
}
