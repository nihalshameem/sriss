<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementBroadcastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sss_advertisement_broadcast_tbl', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('advertisement_id')->unsigned();
            $table->foreign('advertisement_id')->references('id')
                ->on('sss_advertisements_tbl');
            $table->integer('State_id')->unsigned()->nullable();
            $table->foreign('State_id')->references('State_id')
                ->on('sss_state_tbl');
            $table->integer('zone_id')->unsigned()->nullable();
            $table->foreign('zone_id')->references('Zone_id')
                ->on('sss_zones_tbl');
            $table->integer('district_id')->unsigned()->nullable();
            $table->foreign('district_id')->references('District_id')
                ->on('sss_district_tbl');
            $table->integer('taluk_id')->unsigned()->nullable();
            $table->foreign('taluk_id')->references('Union_id')
                ->on('sss_union_tbl');
            $table->enum('active', [ 'Y', 'N'])->default('Y');
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
        Schema::dropIfExists('sss_advertisement_broadcast_tbl');
    }
}
