<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRSPollsResultTBL extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DRS_Polls_Result_TBL', function (Blueprint $table) {
            $table->increments('Polls_Result_id');
            $table->string('Member_id')->nullable();
            $table->unsignedInteger('Questions_id')->nullable();;
            $table->foreign('Questions_id')->references('Polls_Questions_id')->on('drs_polls_questions_tbl');
            $table->string('Response');
            $table->string('Response_count');
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
