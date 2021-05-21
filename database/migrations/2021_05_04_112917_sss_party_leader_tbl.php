<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SssPartyLeaderTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sss_party_leader_tbl', function (Blueprint $table) {
            $table->increments('Party_Id');
            $table->string('Party_name')->nullable();
            $table->string('Party_email')->nullable();
            $table->string('Party_phone')->nullable();
            $table->string('Party_birth_date')->nullable();
            $table->string('Party_death_date')->nullable();
            $table->string('Party_organization')->nullable();
            $table->string('Party_whatsapp_no')->nullable();
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
