<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateDivision extends Model
{
    use HasFactory;

    protected $fillable = [
        'State_Division_desc','State_Division_active'
    ];
    protected $table = 'sss_state_division_tbl';
}
