<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRSGreaterZonesTBL extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DRS_Greater_Zones_Tbl', function (Blueprint $table) {
            $table->increments('Greater_Zones_id');
            $table->unsignedInteger('State_Division_id')->nullable();
            $table->foreign('State_Division_id')
                ->references('State_Division_id')
                ->on('drs_state_division_tbl');
            $table->string('Greater_Zones_desc');
            $table->enum('Greater_Zones_active', [ 'Y', 'N'])->default('Y');
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
