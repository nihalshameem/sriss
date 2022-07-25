<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollsAnswers extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'Polls_Answers_Options'
    ];

    protected $table = 'sss_polls_answers_tbl';

     public function PollsResult()
    {
        return $this->belongsTo(PollsResult::class,'Polls_Answers_id','Answer_id');   
    }

    public function PollsResultCount()
    {
        return $this->belongsTo(PollsResult::class,'Polls_Answers_id','Answer_id');   
    }
}
