<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

      protected $fillable = [
        'Country_desc','Country_active'
    ];

    protected $table = 'drs_country_tbl';
}
