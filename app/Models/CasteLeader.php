<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CasteLeader extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'Caste_Desc'
    ];

    protected $table = 'sss_caste_leader_tbl';
}
