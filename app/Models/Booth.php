<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booth extends Model
{
    use HasFactory;

    protected $table    ='sss_booth_tbl';
    protected $fillable =[  
    						'Booth_Desc',
    						'Polling_Station_No',
    						'Polling_Station_Location',
    						'Polling_Station_Area',
    						'Booth_Agent_Id',
    						'Assembly_Const_Id',
    						'Parliament_Const_Id'
    						];
}
