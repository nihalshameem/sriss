<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReligiousLeader extends Model
{
    use HasFactory;
    protected $fillable = [
        'Religious_Desc'
    ];

    protected $table = 'sss_religious_leader_tbl';
}
