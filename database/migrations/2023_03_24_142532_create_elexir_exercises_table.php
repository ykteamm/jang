<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElexirExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elexir_exercises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('medicine_id');
            $table->integer('elexir');
            $table->integer('plan');
            $table->integer('success');
            $table->date('start_day');
            $table->date('end_day');
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
        Schema::dropIfExists('elexir_exercises');
    }
}
