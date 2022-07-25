<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ward extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('sss_ward_tbl', function (Blueprint $table) {
            $table->increments('Ward_Id');
            $table->string('Ward_Name')->nullable();
            $table->integer('State_Id')->unsigned();
            $table->integer('Dist_Id')->unsigned();
            $table->integer('Area_Id')->unsigned();
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
