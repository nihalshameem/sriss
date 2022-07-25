<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sss_advertisements_tbl', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->string('company');
            $table->string('image_path');
            $table->string('link');
            $table->date('from_date');
            $table->date('to_date');
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
        Schema::dropIfExists('sss_advertisements_tbl');
    }
}
