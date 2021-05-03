<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParliamentConsituency extends Model
{
     use HasFactory;

    protected $table    ='sss_parliament_consituency_tbl';
    protected $fillable =[  
    						'Parliament_Constituency_Desc',
    						'Dist_Id'
    						];
}
