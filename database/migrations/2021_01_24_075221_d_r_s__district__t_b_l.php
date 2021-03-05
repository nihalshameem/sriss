<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRSDistrictTBL extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DRS_District_Tbl', function (Blueprint $table) {
            $table->increments('District_id');
            $table->unsignedInteger('Zone_id')->nullable();
            $table->foreign('Zone_id')
                ->references('Zone_id')
                ->on('drs_zones_tbl');
            $table->string('District_desc');
            $table->enum('District_active', [ 'Y', 'N'])->default('Y');
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
