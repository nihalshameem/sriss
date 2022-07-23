<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table    ='members';
    protected $fillable =[	'member_id',
    						'name',
                            'father_name',
    						'email',
                            'sex',
                            'dob',
                            'address',
    						'country',
    						'state',
    						'zone',
    						'district',
    						'pincode',
    						'mobile_number',
    						'whatsapp_number',
                            'referral_id',
                            'voter_id',
                            'profession',
    						'marital_status',
    						'wedding_date',
    						'spouse_name',    		
    						'spouse_dob',
    						'assembly_constituency',
    						'parliamentary_constituency',
    						'id_card',
                            'profile_picture',
                            'deactivate_reason',
    						];
}
