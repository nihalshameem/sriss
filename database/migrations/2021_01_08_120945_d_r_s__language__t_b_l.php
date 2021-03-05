<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRSLanguageTBL extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('DRS_Language_TBL', function (Blueprint $table) {
            $table->increments('Language_id');
            $table->string('Language_name');
            $table->longText('Language_description');
            $table->enum('Language_active', [ 'Y', 'N'])->default('Y');
            $table->enum('Language_lock', [ 'Y', 'N'])->default('Y');
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
