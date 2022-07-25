<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRSVolunteersTBL extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('DRS_volunteers_TBL', function (Blueprint $table) {
            $table->increments('Volunteer_id');
            $table->string('Member_id')->nullable();
            $table->string('First_Name');
            $table->string('Last_Name');
            $table->string('Address1');
            $table->string('Address2');
            $table->string('Pincode');
            $table->string('DRS_Service_Joining_Date');
            $table->string('DRS_Service_Experience');
            $table->string('DOB');
            $table->string('Age');
            $table->integer('State_Id')->nullable();
            $table->integer('State_Division_Id')->nullable();
            $table->integer('Greater_Zones_Id')->nullable();
            $table->integer('Zones_Id')->nullable();
            $table->integer('District_Id')->nullable();
            $table->integer('Union_Id')->nullable();
            $table->integer('Panchayat_Id')->nullable();
            $table->integer('Village_Id')->nullable();
            $table->integer('Street_Id')->nullable();
            $table->string('Mobile_No');
            $table->string('Whatsapp_No');
            $table->string('Email_Id');
            $table->string('Volunteer_Active');
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
