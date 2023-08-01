<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBattleDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_battle_days', function (Blueprint $table) {
            $table->id();
            $table->foreignId('battle_id');
            $table->foreignId('u1id');
            $table->foreignId('u2id');
            $table->integer('sold1');
            $table->integer('sold2');
            $table->foreignId('win')->nullable();
            $table->foreignId('lose')->nullable();
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
        Schema::dropIfExists('user_battle_days');
    }
}
