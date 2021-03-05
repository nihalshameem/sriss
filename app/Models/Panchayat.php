<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panchayat extends Model
{
    use HasFactory;

     protected $fillable = [
        'Panchayat_desc','Panchayat_active'
    ];
    protected $table = 'sss_panchayat_tbl';
}
