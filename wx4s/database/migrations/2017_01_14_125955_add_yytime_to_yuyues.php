<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddYytimeToYuyues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('yuyues', function (Blueprint $table) {
            //预约时候的时间
            $table->integer('yytime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('yuyues', function (Blueprint $table) {
            $table->dropColumn('yytime');
        });
    }
}
