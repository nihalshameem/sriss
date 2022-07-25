<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRSIdcardTBL extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('DRS_Idcard_TBL', function (Blueprint $table) {
            $table->increments('Id_card_id');
            $table->unsignedInteger('Member_id')->nullable();;
            $table->foreign('Member_id')->references('id')->on('drs_member_tbl');
            $table->string('Member_Image')->nullable();
            $table->string('App_QR_code')->nullable();
            $table->string('Member_barcode')->nullable();
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
