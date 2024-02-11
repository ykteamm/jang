<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopshiriqJavobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topshiriq_javob', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topshiriq_id');
            $table->foreignId('tg_user_id');
            $table->string('topshiriq_key');
            $table->integer('topshiriq_number');
            $table->integer('topshiriq_done');
            $table->integer('topshiriq_star');
            $table->integer('status');
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
        Schema::dropIfExists('topshiriq_javob');
    }
}
