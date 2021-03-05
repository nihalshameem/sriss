<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

     protected $fillable = [
        'State_desc','State_active'
    ];
    protected $table = 'drs_state_tbl';
}
