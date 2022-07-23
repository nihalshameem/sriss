<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $table    ='advertisements';
    protected $fillable =[  
    						'description',
    						'company',
    						'image_path',
    						'banner_image',
    						'link',
    						'fdate',
    						'tdate',
    						'active',
    						];
}
