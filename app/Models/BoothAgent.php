<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoothAgent extends Model
{
     use HasFactory;

    protected $table    ='sss_booth_agent_tbl';
    protected $fillable =[  
    						'Booth_Agent_Desc',
    						'Booth_Agent_Name'
    						];
}
