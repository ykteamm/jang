<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurnirStandingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turnir_standings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->nullable();;
            $table->foreignId('team1_id');
            $table->foreignId('team2_id');
            $table->foreignId('win')->nullable();
            $table->foreignId('lose')->nullable();
            $table->integer('tour')->nullable();
            $table->date('date_begin');
            $table->date('date_end');
            $table->date('month');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('turnir_standings');
    }
}
