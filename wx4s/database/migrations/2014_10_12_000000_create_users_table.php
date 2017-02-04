<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('uid');
            $table->string('openid')->unique()->default('');
            $table->string('nickname')->default('');
            $table->string('name')->default('');
            $table->string('carno')->unique()->default('');
            $table->tinyinteger('sex')->default(0);
            $table->string('city')->default('');
            $table->integer('subscribe_time')->default(0);
            $table->boolean('subscribe')->default(0);
            $table->string('age')->default('');
            $table->string('mobile')->unique()->default('');
            $table->string('email')->unique()->default('');
            $table->tinyinteger('cardtype')->default(0);
            $table->integer('jifen')->default(0);
            $table->string('cardno')->unique()->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
