<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollsQuestions extends Model
{
    use HasFactory;

    protected $fillable = [
        'Polls_Questions','Polls_Questions_From_date','Polls_Questions_To_date'
    ];

    protected $table = 'drs_polls_questions_tbl';
}
