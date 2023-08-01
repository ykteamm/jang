<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsReactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_reactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('tg_user', 'id')->onDelete('CASCADE');
            $table->foreignId('news_id')->constrained('news', 'id')->onDelete('CASCADE');
            $table->foreignId('emoji_id')->constrained('news_emojies', 'id')->onDelete('CASCADE');
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
        Schema::dropIfExists('news_reactions');
    }
}
