<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRSMemberTBL extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DRS_Member_TBL', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Member_Id');
            $table->string('First_Name');
            $table->string('Last_Name');
            $table->string('Address1')->nullable();
            $table->string('Address2')->nullable();
            $table->string('Profile_Picture')->default('http://dharmarakshanasamiti.org/images/committee_members/default_user_logo.png');
            $table->string('Pincode');
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
            $table->string('Email_Id')->unique();
            $table->string('Pan_No');
            $table->enum('Activities', [ 'Y', 'N'])->default('Y');
            $table->string('DOB')->nullable();
            $table->string('Age')->nullable();
            $table->string('Wedding_Date')->nullable();
            $table->string('Member_Designation')->nullable();
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
