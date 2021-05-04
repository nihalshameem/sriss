<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartyLeader extends Model
{
    use HasFactory;
    protected $fillable = [
        'Party_Desc'
    ];

    protected $table = 'sss_party_leader_tbl';
}
