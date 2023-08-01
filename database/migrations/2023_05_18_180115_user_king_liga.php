<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserKingLiga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_king_liga', function(Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('tg_user', 'id')->onDelete("CASCADE");
            $table->foreignId('king_liga_id')->constrained('king_ligas', 'id')->onDelete("CASCADE");
            $table->boolean('inc')->default(false);
            $table->boolean('dec')->default(false);
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
        //
    }
}
