<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Union extends Model
{
    use HasFactory;

    protected $fillable = [
        'Union_desc','Union_active'
    ];
    protected $table = 'drs_union_tbl';
}
