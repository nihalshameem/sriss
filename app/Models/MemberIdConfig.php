<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberIdConfig extends Model
{
    protected $fillable = [
        'MemberIdFormat'
        ];

    protected $table = 'drs_memberid_config_tbl';

}
