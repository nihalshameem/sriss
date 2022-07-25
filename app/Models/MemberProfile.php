<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'field_name','d_label','l2_lable','l3_lable','active'
    ];

    protected $table = 'sss_member_profile_tbl';
}
