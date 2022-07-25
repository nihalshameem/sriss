<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertisementBroadcast extends Model
{
    use HasFactory;

    protected $table    ='sss_advertisement_broadcast_tbl';
    protected $fillable =[	
    						'active'
    						];
}
