<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationGroupBroadcast extends Model
{
    use HasFactory;
    protected $fillable = [
        'active'
    ];

    protected $table = 'sss_notification_group_broadcast_tbl';

    public function Notification()
    {
        return $this->hasMany(Notification::class, 'Notification_id','id');
    }
}
