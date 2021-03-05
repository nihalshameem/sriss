<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    use HasFactory;

    protected $fillable = [
        'Street_desc','Street_active'
    ];
    
    protected $table = 'drs_street_tbl';
}
