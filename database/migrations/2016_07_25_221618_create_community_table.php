<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommunityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('community', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('owner_id', false);
            $table->unsignedInteger('profile_id', false);
            $table->string('name')->unique();

            $table->foreign('owner_id')->references('id')->on('users');
            $table->foreign('profile_id')->references('id')->on('community_profile');

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
        Schema::drop('community');
    }
}
