<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineContribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'Online_Contribution_amount','Online_Contribution_date','order_id','Member_id','payment_status','digital_signature','email_id','mobile_number','payment_id'
    ];

    protected $table = 'drs_online_contribution_tbl';
}
