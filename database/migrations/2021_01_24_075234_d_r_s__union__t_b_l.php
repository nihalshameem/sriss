<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRSUnionTBL extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('DRS_Union_Tbl', function (Blueprint $table) {
            $table->increments('Union_id');
            $table->unsignedInteger('District_id')->nullable();
            $table->foreign('District_id')
                ->references('District_id')
                ->on('drs_district_tbl');
            $table->string('Union_desc');
            $table->enum('Union_active', [ 'Y', 'N'])->default('Y');
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
