<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssemblyConsituency extends Model
{
   use HasFactory;

    protected $table    ='sss_assembly_consituency_tbl';
    protected $fillable =[  
    						'Assembly_Constituency_Desc',
    						'Dist_Id'
    						];
}
