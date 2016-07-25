<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommunityMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('community_members', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('community_id', false);
            $table->unsignedInteger('member_id', false);

            $table->foreign('community_id')->references('id')->on('community');
            $table->foreign('member_id')->references('id')->on('members');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('community_members');
    }
}
