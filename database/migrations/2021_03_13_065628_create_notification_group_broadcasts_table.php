<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationGroupBroadcastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sss_notification_group_broadcast_tbl', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('Group_id')->unsigned();
            $table->foreign('Group_id')->references('Group_id')
                ->on('sss_member_group_tbl');

            $table->integer('Notification_id')->unsigned();
            $table->foreign('Notification_id')->references('Notification_id')
                ->on('sss_notification_tbl');
                
            $table->enum('active', ['Y','N'])->default('Y');
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
        Schema::dropIfExists('sss_notification_group_broadcast_tbl');
    }
}
