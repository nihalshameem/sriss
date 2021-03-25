<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{

     protected $fillable = [
        'Language_name','Language_description','Language_active', 'Language_lock'
    ];

    protected $table = 'sss_languages_tbl';
}
