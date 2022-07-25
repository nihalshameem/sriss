<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRSNotificationTBL extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('DRS_Notification_TBL', function (Blueprint $table) {
            $table->increments('Notification_id');
            $table->string('Notification_mesage')->nullable();
            $table->string('Notification_start_date')->nullable();
            $table->string('Notification_end_date')->nullable();
            $table->string('Notification_image_path')->nullable();
            $table->enum('Notification_active', [ 'N', 'Y'])->default('N');
            $table->enum('Notification_approved', [ 'N', 'Y'])->default('N');
            $table->enum('Notification_delete', [ 'N', 'Y'])->default('N');
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
