<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBattleDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tg_battle_day', function (Blueprint $table) {
            $table->id();
            $table->foreignId('u1id');
            $table->foreignId('u2id');
            $table->integer('price1');
            $table->integer('price2');
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
        Schema::dropIfExists('battle_days');
    }
}
