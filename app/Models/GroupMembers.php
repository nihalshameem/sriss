<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMembers extends Model
{
    use HasFactory;
    protected $fillable = [
        'Member_Id','active'
    ];

    protected $table = 'sss_group_members_tbl';
}
