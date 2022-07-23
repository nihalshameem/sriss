<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyfamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('myfamilies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('member_id');
            $table->string('email')->unique();
            $table->string('ggfather')->nullable();
            $table->string('ggmother')->nullable();
            $table->string('gfather')->nullable();
            $table->string('gmother')->nullable();
            $table->string('father');
            $table->string('mother');
            $table->string('ggfather_dob')->nullable();
            $table->string('ggmother_dob')->nullable();
            $table->string('gfather_dob')->nullable();
            $table->string('gmother_dob')->nullable();
            $table->string('father_dob')->nullable();
            $table->string('mother_dob')->nullable();
            $table->string('mother_dob')->nullable();
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
        Schema::dropIfExists('myfamilies');
    }
}
