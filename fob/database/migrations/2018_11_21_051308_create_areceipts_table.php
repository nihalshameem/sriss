<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areceipts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('advertisement_id');
            $table->string('zone_id')->nullable();
            $table->string('district_id')->nullable();
            $table->string('taluk_id')->nullable();
            $table->string('pincode_id')->nullable();
            $table->string('active')->nullable();
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
        Schema::dropIfExists('areceipts');
    }
}
