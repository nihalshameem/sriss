<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonationText extends Model
{
    protected $table    ='donations_text';
    protected $fillable =[	'type',
    						'category',
    						'subcategory',
    						'tamil',
    						'english',
    						'hindi',
    						'per_day_amount',
    						'no_of_days',
    						'noOfPersons',
    						'amount_1',
    						'amount_2',
    						'amount_3',
    						'amount_4',
    						];
}
