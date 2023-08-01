<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBattlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_battles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('u1id');
            $table->foreignId('u2id');
            $table->integer('price1');
            $table->integer('price2');
            $table->foreignId('win')->nullable();
            $table->foreignId('lose')->nullable();
            $table->double('ball1',8,2)->nullable();
            $table->double('ball2',8,2)->nullable();
            $table->double('uball1',8,2)->nullable();
            $table->double('uball2',8,2)->nullable();
            $table->integer('days');
            $table->integer('day')->default(0);
            $table->date('start_day');
            $table->date('end_day');
            $table->integer('bot')->default(0);
            $table->integer('ends')->default(0);
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
        Schema::dropIfExists('user_battles');
    }
}
