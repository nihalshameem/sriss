<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRSOnlineContributionTBL extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DRS_Online_Contribution_TBL', function (Blueprint $table) {
            $table->increments('Online_Contribution_id');
            $table->string('Member_id');
            $table->string('Online_Contribution_amount');
            $table->string('Online_Contribution_date');
            $table->string('Online_Contribution_razorpay_code');
            $table->string('Online_Contribution_razorpay_status');
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
