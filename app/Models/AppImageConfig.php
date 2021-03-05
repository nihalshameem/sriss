<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppImageConfig extends Model
{
    use HasFactory;

      protected $fillable = [
        'App_image_path','App_image_text','App_image_visible_lock'
    ];

    protected $table = 'sss_app_images_tbl';

     public function AppImage()
    {
        return $this->belongsTo(AppImage::class,'App_cat_id','App_image_cat_id');   
    }
}
