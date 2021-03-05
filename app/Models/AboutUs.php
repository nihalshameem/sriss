<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{

     protected $fillable = [
        'Aboutus_description'
    ];

    protected $table = 'drs_aboutus_tbl';
}
