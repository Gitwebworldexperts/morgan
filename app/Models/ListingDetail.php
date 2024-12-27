<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingDetail extends Model
{
    use HasFactory;

    // If your table name is not the plural of the model, specify the table name
    protected $table = 'listing_detail';

    // Define the columns you want to be mass-assignable
    protected $fillable = [
       "breadcrumbs","page_name","blog_heading","blog_description","blog_background","blog_button_label","blog_button_url","meta_tags"
    ];

    // If you want to specify a different date format for the timestamps
    protected $dateFormat = 'Y-m-d H:i:s';

}
