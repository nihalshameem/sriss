<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRSAppIconTBL extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DRS_App_Icon_TBL', function (Blueprint $table) {
            $table->increments('AppIcon_id');
            $table->string('AppIcon_desc');
            $table->string('AppIcon_image_path');
            $table->string('AppIcon_image_width');
            $table->string('AppIcon_text');
            $table->enum('AppIcon_visible', [ 'Y', 'N'])->default('Y');
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
