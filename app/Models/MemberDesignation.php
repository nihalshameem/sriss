<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberDesignation extends Model
{
    use HasFactory;

     protected $fillable = [
        'designation'
    ];

    protected $table = 'sss_member_designation_tbl';
}
