<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRSContributionModeTypeTBL extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DRS_Contribution_Mode_Type_TBL', function (Blueprint $table) {
            $table->increments('Contribution_Mode_Type_id');
            $table->unsignedInteger('Contribution_Mode_id')->nullable();;
            $table->foreign('Contribution_Mode_id')->references('Contribution_Mode_id')->on('drs_contribution_mode_tbl');
            $table->string('Contribution_Mode_desc');
            $table->string('Contribution_Mode_type_code');
            $table->string('Contribution_Mode_type_desc');
            $table->string('Contribution_Mode_type_active');
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
