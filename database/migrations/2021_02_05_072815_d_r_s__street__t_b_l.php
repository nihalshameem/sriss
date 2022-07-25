<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRSStreetTBL extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DRS_Street_Tbl', function (Blueprint $table) {
            $table->increments('Street_id');
            $table->unsignedInteger('Village_id')->nullable();
            $table->foreign('Village_id')
                ->references('Village_id')
                ->on('drs_village_tbl');
            $table->string('Street_desc');
            $table->enum('Street_active', [ 'Y', 'N'])->default('Y');
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
