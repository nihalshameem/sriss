<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zones extends Model
{
    use HasFactory;

        protected $fillable = [
        'Zone_desc','Zone_active'
    ];
    protected $table = 'sss_zones_tbl';
}
