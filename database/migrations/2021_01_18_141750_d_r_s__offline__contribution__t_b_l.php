<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRSOfflineContributionTBL extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DRS_Offline_Contribution_TBL', function (Blueprint $table) {
            $table->increments('Offline_Contribution_id');
            $table->string('Member_id')->nullable();
            $table->string('First_Name');
            $table->string('Last_Name');
            $table->string('Mobile_No');
            $table->string('Whatsapp_No');
            $table->string('drs_Inst_Type');
            $table->string('drs_Inst_No');
            $table->string('Email_Id');
            $table->string('Offline_Contribution_amount');
            $table->string('Offline_Contribution_date');
            $table->string('Offline_Contribution_payment_status');
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
