<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRSPollsQuestionsTBL extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DRS_Polls_Questions_TBL', function (Blueprint $table) {
            $table->increments('Polls_Questions_id');
            $table->string('Polls_Questions');
            $table->string('Polls_Questions_From_date');
            $table->string('Polls_Questions_To_date');
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
