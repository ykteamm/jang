<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsBattlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_battles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('u1id');
            $table->foreignId('u2id');
            $table->foreignId('battle_id');
            $table->integer('sms');
            $table->integer('bot');
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
        Schema::dropIfExists('sms_battles');
    }
}
