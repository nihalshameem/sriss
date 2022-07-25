<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRSNewletterTBL extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DRS_Newsletter_TBL', function (Blueprint $table) {
            $table->increments('Newsletter_id');
            $table->string('Newsletter_desc');
            $table->date('Newsletter_date');
            $table->longText('Newsletter');
            $table->unsignedInteger('Language_id');
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
