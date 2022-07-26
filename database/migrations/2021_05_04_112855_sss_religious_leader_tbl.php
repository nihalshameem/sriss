<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SssReligiousLeaderTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('sss_religious_leader_tbl', function (Blueprint $table) {
            $table->increments('Religious_Id');
            $table->string('Religious_name')->nullable();
            $table->string('Religious_email')->nullable();
            $table->string('Religious_phone')->nullable();
            $table->string('Religious_birth_date')->nullable();
            $table->string('Religious_death_date')->nullable();
            $table->string('Religious_organization')->nullable();
            $table->string('Religious_address')->nullable();
            $table->string('Religious_whatsapp_no')->nullable();
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
