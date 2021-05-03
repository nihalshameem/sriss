<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ParliamentConsituency extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('sss_parliament_consituency_tbl', function (Blueprint $table) {
            $table->increments('Parliament_Id');
            $table->string('Parliament_Constituency_Desc')->nullable();
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
