<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollsBroadcast extends Model
{
    use HasFactory;

     protected $fillable = [
        'Polls_id','State_id','State_Division_id','Greater_Zones_id','Zone_id','District_id','Union_id'
    ];

    protected $table = 'sss_polls_broadcast_tbl';
}
