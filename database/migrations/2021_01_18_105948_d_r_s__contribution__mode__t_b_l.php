<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRSContributionModeTBL extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DRS_Contribution_Mode_TBL', function (Blueprint $table) {
            $table->increments('Contribution_Mode_id');
            $table->string('Contribution_Mode_desc');
            $table->string('Contribution_Mode_code');
            $table->string('Contribution_Mode_active');
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
