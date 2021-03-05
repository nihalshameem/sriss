<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'field_name','active'
    ];

    protected $table = 'drs_member_profile_tbl';
}
