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
            $table->string('email')->unique();
            $table->string('email_verification_status');
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('country');
            $table->string('state');
            $table->string('zone')->nullable();
            $table->string('district');
            $table->string('taluk')->nullable();
            $table->string('pincode');
            $table->string('mobile_number');
            $table->string('whatsapp_number')->nullable();
            $table->string('landline_number')->nullable();
            $table->string('sex');
            $table->string('dob');
            $table->string('religion')->nullable();
            $table->string('caste')->nullable();
            $table->string('subsect_1')->nullable();
            $table->string('subsect_2')->nullable();
            $table->string('aacharyan')->nullable();
            $table->string('mutt')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('wedding_date')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('spouse_dob')->nullable();
            $table->string('profession')->nullable();
            $table->string('volunteer_int')->nullable();
            $table->string('donate_int')->nullable();
            $table->string('referral_id')->nullable();
            $table->string('profile_comp_status');
            $table->string('active_flag')->default('yes');
             $table->string('deactivate_reason')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('id_card')->nullable();
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
