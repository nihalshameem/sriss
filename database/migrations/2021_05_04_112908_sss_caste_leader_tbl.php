<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SssCasteLeaderTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sss_caste_leader_tbl', function (Blueprint $table) {
            $table->increments('Caste_Id');
            $table->string('Caste_name')->nullable();
            $table->string('Caste_email')->nullable();
            $table->string('Caste_phone')->nullable();
            $table->string('Caste_birth_date')->nullable();
            $table->string('Caste_death_date')->nullable();
            $table->string('Caste_organization')->nullable();
            $table->string('Caste_address')->nullable();
            $table->string('Caste_whatsapp_no')->nullable();
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
