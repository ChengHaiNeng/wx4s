<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyColumnsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('carno')->default('');
            $table->string('mobile')->default('');
            $table->string('email')->default('');
            $table->string('cardno')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $this->dropColumn('carno');
            $this->dropColumn('mobile');
            $this->dropColumn('email');
            $this->dropColumn('cardno');
        });
    }
}
