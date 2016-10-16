<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('community_id', false);
            
            $table->string("name")->default("My Community Server");
            $table->string("ip_address")->default("0.0.0.0");
            $table->string("port")->default("0000");
            $table->string("query_port")->default("0001");

            $table->foreign('community_id')->references('id')->on('community');

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
        Schema::drop('servers');
    }
}
