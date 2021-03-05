<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppIcon extends Model
{
    use HasFactory;

      protected $fillable = [
        'AppIcon_desc','AppIcon_image_path','AppIcon_image_width','AppIcon_text','AppIcon_visible'
    ];

    protected $table = 'sss_app_icon_tbl';
}
