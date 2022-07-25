<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'Subscription_amount','Subscription_date','order_id','Member_id','payment_status','digital_signature','email_id','mobile_number','payment_id'
    ];

    protected $table = 'sss_subscription_tbl';
}
