<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeyStoreTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keystores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('shope_en_name');
            $table->string('shope_ar_name');
            $table->float('lat');
            $table->float('lng');
            $table->string('address');
            $table->string('typeOfService');
            $table->float('n_w_hours');
            $table->date('begin_day');
            $table->date('end_day');
            $table->boolean('activeStatues');
            $table->string('logo');
            $table->integer('user_id');
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
        Schema::drop('keystores');
    }
}
