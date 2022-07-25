<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRSPollsAnswersTBL extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('DRS_Polls_Answers_TBL', function (Blueprint $table) {
            $table->increments('Polls_Answers_id');
            $table->unsignedInteger('Questions_id')->nullable();;
            $table->foreign('Questions_id')->references('Polls_Questions_id')->on('drs_polls_questions_tbl');
            $table->string('Polls_Answers_Options');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
