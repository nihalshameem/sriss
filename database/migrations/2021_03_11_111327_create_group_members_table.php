<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sss_group_members_tbl', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Group_id')->unsigned();
            $table->foreign('Group_id')->references('Group_id')
                ->on('sss_member_group_tbl');
            $table->integer('Member_tbl_id')->unsigned();
            $table->foreign('Member_tbl_id')->references('id')
                ->on('sss_member_tbl');
            $table->string('Member_Id');
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
        //Schema::dropIfExists('sss_group_members_tbl');
    }
}
