<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportForm extends Model
{
    use HasFactory;

    protected $table = 'report_form';

    protected $fillable = ['first_name', 'last_name', 'email', 'newsletter','mobile','report_id'];
}
