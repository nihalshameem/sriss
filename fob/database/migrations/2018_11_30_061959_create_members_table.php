<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('member_id');
            $table->string('name');
            $table->string('father_name');
            $table->string('email')->unique();
            $table->string('sex');
            $table->string('dob');
            $table->string('address');
            $table->string('country');
            $table->string('state');
            $table->string('zone')->nullable();
            $table->string('district');
            $table->string('pincode');
            $table->string('mobile_number');
            $table->string('whatsapp_number')->nullable();
            $table->string('referral_id')->nullable();
            $table->string('voter_id')->nullable();
            $table->string('profession')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('wedding_date')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('spouse_dob')->nullable();
            $table->string('assembly_constituency')->nullable();
            $table->string('parliamentary_constituency')->nullable();
            $table->string('id_card')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('deactivate_reason')->nullable();
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
        Schema::dropIfExists('members');
    }
}
