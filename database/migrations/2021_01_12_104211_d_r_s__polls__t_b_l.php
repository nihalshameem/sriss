<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRSPollsTBL extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DRS_Polls_TBL', function (Blueprint $table) {
            $table->increments('Polls_id');
            $table->string('Polls_description')->nullable();
            $table->string('Polls_question')->nullable();
            $table->string('Polls_answers_option_1')->nullable();
            $table->string('Polls_answers_option_2')->nullable();
            $table->string('Polls_answers_option_3')->nullable();
            $table->string('Polls_answers_option_4')->nullable();
            $table->string('Polls_answers_option_5')->nullable();
            $table->string('Polls_image_path')->nullable();
            $table->enum('Polls_active', [ 'N', 'Y'])->default('N');
            $table->string('Polls_start_date')->nullable();
            $table->string('Polls_end_date')->nullable();
            $table->unsignedInteger('Language_id')->nullable();;
            $table->foreign('Language_id')->references('Language_id')->on('drs_language_tbl');
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
