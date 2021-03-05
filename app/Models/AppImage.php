<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppImage extends Model
{
    use HasFactory;

      protected $fillable = [
        'App_image_cat_name','App_image_cat_desc'
    ];

    protected $table = 'drs_app_images_cat_tbl';

    
}
