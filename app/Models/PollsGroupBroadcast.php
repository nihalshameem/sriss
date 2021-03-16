<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollsGroupBroadcast extends Model
{
    use HasFactory;
    protected $fillable = [
        'active'
    ];

    protected $table = 'sss_polls_group_broadcast_tbl';
}
