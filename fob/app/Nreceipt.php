<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nreceipt extends Model
{
    protected $table    ='nreceipts';
    protected $fillable =[	'notification_id',
    						'zone_id',
    						'district_id',
    						'taluk_id',
    						'pincode_id',
    						'active',
    						];
}
