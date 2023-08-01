<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBattleElchisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tg_battle_elchi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('battle_id');
            $table->foreignId('u1id');
            $table->foreignId('u2id');
            $table->integer('price1');
            $table->integer('price2');
            $table->integer('win');
            $table->integer('lose');
            $table->double('ball1',8,2);
            $table->double('ball2',8,2);
            $table->double('uball1',8,2);
            $table->double('uball2',8,2);
            $table->date('battle_date');
            $table->integer('bot')->default(0);
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
        Schema::dropIfExists('battle_elchis');
    }
}
