<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;


    protected $fillable = [
        'Notification_mesage','Notification_start_date','Notification_end_date','Notification_image_path','Notification_active','Notification_approved','Notification_delete','Notification_text'
    ];

    protected $table = 'sss_notification_tbl';
}
