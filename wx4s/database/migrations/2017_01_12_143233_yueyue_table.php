<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class YueyueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yuyues', function (Blueprint $table) {
            $table->increments('yid');
            $table->string('carno')->default('');
            $table->string('name')->default('');
            $table->string('mobile')->default('');
            $table->integer('time')->default(0);
            $table->string('miles')->default('');
            $table->string('openid')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('yuyues');
    }
}
