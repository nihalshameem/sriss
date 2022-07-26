<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRSZonesTBL extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DRS_Zones_Tbl', function (Blueprint $table) {
            $table->increments('Zone_id');
            $table->unsignedInteger('Greater_Zones_id')->nullable();
            $table->foreign('State_id')
                ->references('State_id')
                ->on('drs_state_tbl');
            $table->string('Zone_desc');
            $table->enum('Zone_active', [ 'Y', 'N'])->default('Y');
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
