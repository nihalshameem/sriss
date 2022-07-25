<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AssemblyConsituency extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('sss_assembly_consituency_tbl', function (Blueprint $table) {
            $table->increments('Assembly_Id');
            $table->string('Assembly_Constituency_Desc')->nullable();
            $table->integer('Dist_Id')->unsigned();
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
