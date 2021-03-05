<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRSAppImagesConfigTBL extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DRS_App_Images_config_TBL', function (Blueprint $table) {
            $table->increments('App_image_config_id');
            $table->string('App_image_config_description')->nullable();
            $table->unsignedInteger('App_cat_id')->nullable();
            $table->foreign('App_cat_id')->references('App_image_cat_id')->on('drs_app_images_cat_tbl');
            $table->string('App_image_path')->nullable();
            $table->string('App_image_width_in_dp')->nullable();
            $table->string('App_image_height_in_dp')->nullable();
            $table->string('App_image_text')->nullable();
            $table->enum('App_image_visible_lock', [ 'Y', 'N'])->default('Y');
            $table->enum('App_image_config_active', [ 'Y', 'N'])->default('Y');
            $table->unsignedInteger('Language_id')->nullable();;
            $table->foreign('Language_id')->references('Language_id')->on('drs_language_tbl');
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
