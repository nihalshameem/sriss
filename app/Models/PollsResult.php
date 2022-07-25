<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollsResult extends Model
{
    use HasFactory;

     protected $fillable = [
        'Member_id','response_count','Questions_id'];

    protected $table = 'sss_polls_result_tbl';


    public function PollsAnswers()
    {
        return $this->hasOne(PollsAnswers::class,'Answer_id','Polls_Answers_id');   
    }
}
