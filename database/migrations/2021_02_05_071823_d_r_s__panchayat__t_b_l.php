<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRSPanchayatTBL extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('DRS_Panchayat_Tbl', function (Blueprint $table) {
            $table->increments('Panchayat_id');
            $table->unsignedInteger('Union_id')->nullable();
            $table->foreign('Union_id')
                ->references('Union_id')
                ->on('drs_union_tbl');
            $table->string('Panchayat_desc');
            $table->enum('Panchayat_active', [ 'Y', 'N'])->default('Y');
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
