<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCrystallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_crystalls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('tg_user', 'id')->onDelete("CASCADE");
            $table->integer('crystall')->default(1280);
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
        Schema::dropIfExists('user_crystalls');
    }
}
