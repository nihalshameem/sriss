<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table    ='members';
    protected $fillable =[	'member_id',
    						'name',
    						'email',
    						'email_verification_status',
    						'address_1',
    						'address_2',
    						'country',
    						'state',
    						'zone',
    						'district',
    						'taluk',
    						'pincode',
    						'mobile_number',
    						'whatsapp_number',
    						'landline_number',
    						'sex',
    						'dob',
    						'religion',
    						'caste',
    						'subsect_1',
    						'subsect_2',
    						'aacharyan',
    						'mutt',
    						'marital_status',
    						'wedding_date',
    						'spouse_name',    						
    						'spouse_dob',
    						'profession',
    						'volunteer_int',
    						'donate_int',
    						'referral_id',
    						'profile_comp_status',
    						'active_flag',
    						'deactivate_reason',
    						'profile_picture',
    						'id_card',
    						];
}
