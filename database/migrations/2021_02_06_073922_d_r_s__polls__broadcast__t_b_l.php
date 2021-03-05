<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRSPollsBroadcastTBL extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DRS_Polls_Broadcast_Tbl', function (Blueprint $table) {
            $table->increments('Polls_Broadcast_id');
            $table->unsignedInteger('Polls_id')->nullable();
            
            $table->foreign('Polls_id')
                ->references('id')
                ->on('drs_polls_questions_tbl');

            $table->unsignedInteger('State_id')->nullable();
            $table->foreign('State_id')
                ->references('State_id')
                ->on('drs_state_tbl');

            $table->unsignedInteger('State_Division_id')->nullable();
            $table->foreign('State_Division_id')
                ->references('State_Division_id')
                ->on('drs_state_division_tbl');

            $table->unsignedInteger('Greater_Zones_id')->nullable();
            $table->foreign('Greater_Zones_id')
                ->references('Greater_Zones_id')
                ->on('drs_greater_zones_tbl');

            $table->unsignedInteger('Zone_id')->nullable();
            $table->foreign('Zone_id')
                ->references('Zone_id')
                ->on('drs_zones_tbl');

            $table->unsignedInteger('District_id')->nullable();
            $table->foreign('District_id')
                ->references('District_id')
                ->on('drs_district_tbl');

            $table->unsignedInteger('Union_id')->nullable();
            $table->foreign('Union_id')
                ->references('Union_id')
                ->on('drs_union_tbl');

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
