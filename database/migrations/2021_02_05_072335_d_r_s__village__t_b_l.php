<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRSVillageTBL extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DRS_Village_Tbl', function (Blueprint $table) {
            $table->increments('Village_id');
            $table->unsignedInteger('Panchayat_id')->nullable();
            $table->foreign('Panchayat_id')
                ->references('Panchayat_id')
                ->on('drs_panchayat_tbl');
            $table->string('Village_desc');
            $table->enum('Village_active', [ 'Y', 'N'])->default('Y');
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
