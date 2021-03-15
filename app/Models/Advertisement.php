<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $table    ='sss_advertisements_tbl';
    protected $fillable =[  
    						'description',
    						'company',
    						'image_path',
    						'banner_image',
    						'link',
    						'from_date',
    						'to_date',
    						'active',
    						];
}
