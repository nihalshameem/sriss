<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

     protected $fillable = [
        'Member_Id','First_Name','Last_Name', 'Address1','Address2','Pincode','State_Id','State_Division_Id','Greater_Zones_Id','Zones_Id','District_Id','Union_Id','Panchayat_Id','Village_Id','Street_Id','Mobile_No','Whatsapp_No','Email_Id','DOB','Age','Volunteer_Active','DRS_Service_Joining_Date','DRS_Service_Experience'
    ];

    protected $table = 'drs_volunteers_tbl';
}
