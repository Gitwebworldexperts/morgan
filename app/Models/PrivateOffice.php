<?php 
// app/Models/PrivateOffice.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateOffice extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'expert_image', 'expert_name', 'expert_post', 
        'contact_link', 'section_2_heading', 'expert_description', 
        'mastery_description', 'result_description', 'access_description',
        'confidentiality_description', 'legal_description', 'section_3_heading',
        'input_fields'
    ];

    protected $casts = [
        'input_fields' => 'array', // Cast the JSON input fields into an array
    ];
}
