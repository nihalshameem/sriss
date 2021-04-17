<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'Member_Id','Member_Category_Id','Referrar_Phone_No','Member_Approved_Flag','Approval_Id','First_Name','Last_Name', 'Address_Line_1','Address_Line_2','Pincode','State_Id','Voter_Id_card_no','Marital_Status','Zones_Id','District_Id','Member_Nationality_Desc','Member_Religion_Desc','Member_Caste_Desc','Member_Religious_Leader_Name','Mobile_No','Whatsapp_No','Email_Id','Pan_No','DOB','Age','Wedding_Date','Member_Designation','Member_image','Member_Caste_Leader_Name','Spouse_Name','Spouse_DOB','Spouse_Age','Assembly_Constituency_Desc','Parliament_Constituency_Desc','Ward_No','Ward_Desc','Booth_No','Booth_Desc',' Polling_Area','Gothram',' Birth_Star','Profession','Text_Field_1','Text_Field_2','Text_Field_3','Text_Field_4','Text_Field_5','Text_Field_6','Text_Field_7','Text_Field_8','Text_Field_9','Text_Field_10','Date_Field_1','Date_Field_2',' Date_Field_3','Date_Field_4',' Date_Field_5','Yes_No_Field_1','Yes_No_Field_2','Yes_No_Field_3','Yes_No_Field_4','Yes_No_Field_5','Language_id','Member_Active_Flag','Zones_Id'
    ];

    protected $table = 'sss_member_tbl';
}
