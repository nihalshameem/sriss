<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Polls extends Model
{
     use HasFactory;

    protected $fillable = [
        'Polls_description','Polls_question','Polls_answers_option_1','Polls_answers_option_2','Polls_answers_option_3','Polls_answers_option_4','Polls_answers_option_5','Polls_image_path','Polls_active','Polls_start_date','Polls_end_date'
    ];

    protected $table = 'drs_polls_tbl';
}
