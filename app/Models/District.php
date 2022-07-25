<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

     protected $fillable = [
        'District_desc','District_active'
    ];
    protected $table = 'sss_district_tbl';
}
