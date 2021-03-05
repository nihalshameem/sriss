<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compliance extends Model
{
    use HasFactory;

    protected $fillable = [
        'Compliance_desc','Compliance_text','Compliance_active','Version_no'
    ];

    protected $table = 'sss_compliance_tbl';

}
