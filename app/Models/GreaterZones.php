<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GreaterZones extends Model
{
    use HasFactory;

    protected $fillable = [
        'Greater_Zones_desc','Greater_Zones_active'
    ];
    protected $table = 'drs_greater_zones_tbl';
}
