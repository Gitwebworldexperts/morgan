<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $table = 'job_applications'; // Updated table name

    protected $fillable = [
        'career_id',
        'full_name',
        'email',
        'experience',
        'contact_number',
        'resume_path',
    ];
}
