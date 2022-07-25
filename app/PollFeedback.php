<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollFeedback extends Model
{
    protected $table = "pollfeedbacks";

    protected $fillable = [
    	'memberId',
    	'emailId',
    	'questionId',
    	'responseId',
    ];
}
