<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRSStateTBL extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DRS_State_Tbl', function (Blueprint $table) {
            $table->increments('State_id');
            $table->unsignedInteger('Country_id')->nullable();
            $table->foreign('Country_id')
                ->references('Country_id')
                ->on('drs_country_tbl');
            $table->string('State_desc');
            $table->enum('State_active', [ 'Y', 'N'])->default('Y');
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
