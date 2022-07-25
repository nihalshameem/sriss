<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRSStateDivisionTBL extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DRS_State_Division_Tbl', function (Blueprint $table) {
            $table->increments('State_Division_id');
            $table->unsignedInteger('State_id')->nullable();
            $table->foreign('State_id')
                ->references('State_id')
                ->on('drs_state_tbl');
            $table->string('State_Division_desc');
            $table->enum('State_Division_active', [ 'Y', 'N'])->default('Y');
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
