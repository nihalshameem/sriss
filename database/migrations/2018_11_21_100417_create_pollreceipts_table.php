<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollreceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pollreceipts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question_id');
            $table->string('zone_id')->nullable();
            $table->string('district_id')->nullable();
            $table->string('taluk_id')->nullable();
            $table->string('pincode_id')->nullable();
            $table->string('active')->default('yes');
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
        Schema::dropIfExists('pollreceipts');
    }
}
