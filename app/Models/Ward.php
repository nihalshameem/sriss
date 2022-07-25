<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
      use HasFactory;

    protected $table    ='sss_ward_tbl';
    protected $fillable =[  
    						'Ward_Name',
    						'State_Id',
    						'Dist_Id',
    						'Area_Id',
    						'Assembly_Const_Id',
    						'Parliament_Const_Id'
    						];
}
