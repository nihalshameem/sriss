<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRSAppImagesCatTBL extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('DRS_App_Images_Cat_TBL', function (Blueprint $table) {
            $table->increments('App_image_cat_id');
            $table->string('App_image_cat_name');
            $table->string('App_image_cat_desc');
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
