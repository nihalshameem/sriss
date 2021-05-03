<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Booth extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sss_booth_tbl', function (Blueprint $table) {
            $table->increments('Booth_Id');
            $table->string('Booth_Desc')->nullable();
            $table->integer('Ward_Id')->unsigned();
            $table->foreign('Ward_Id')->references('Ward_Id')
                ->on('sss_ward_tbl');
            $table->string('Polling_Station_No')->nullable();
            $table->string('Polling_Station_Location')->nullable();
            $table->string('Polling_Station_Area')->nullable();
            $table->integer('Booth_Agent_Id')->unsigned();
            $table->foreign('Booth_Agent_Id')->references('Booth_Agent_Id')
                ->on('sss_booth_agent_tbl');
            $table->integer('Assembly_Const_Id')->unsigned();
            $table->foreign('Assembly_Const_Id')->references('Assembly_Id')
                ->on('sss_assembly_consituency_tbl');
            $table->integer('Parliament_Const_Id')->unsigned();
            $table->foreign('Parliament_Const_Id')->references('Parliament_Id')
                ->on('sss_parliament_consituency_tbl');
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
