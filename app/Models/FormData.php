<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormData extends Model
{
    use HasFactory;
    protected $fillable = [
        'full_name',
        'email',
        'contact_number',
        'message',
        'page_name',
        'page_id',
        'ip_address',
        'is_api'
    ];
}
