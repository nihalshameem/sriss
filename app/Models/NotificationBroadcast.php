<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationBroadcast extends Model
{
    use HasFactory;

     protected $fillable = [
        'Notification_id','State_id','State_Division_id','Greater_Zones_id','Zone_id','District_id','Union_id'
    ];

    protected $table = 'sss_notification_broadcast_tbl';
}
