<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberGroup extends Model
{
    use HasFactory;
    protected $fillable = [
        'group_name','active'
    ];

    protected $table = 'sss_member_group_tbl';
}
