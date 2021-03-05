<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfflineContribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'Member_id','First_Name','Last_Name','Mobile_No','Whatsapp_No','drs_Inst_Type',
        'drs_Inst_No','Email_Id','Offline_Contribution_amount','Offline_Contribution_date',
        'Offline_Contribution_payment_status','pincode','pan_number','karyakathas_name',
        'postal_address','Realised_amount','Due_amount'
    ];

    protected $table = 'sss_offline_contribution_tbl';
}
