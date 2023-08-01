<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tg_shift', function (Blueprint $table) {
            $table->id();
            $table->timestamp('open_date')->nullable();
            $table->timestamp('close_date')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('pharma_id');
            $table->integer('active');
            $table->string('open_code');
            $table->string('close_code');
            $table->jsonb('admin_check')->nullable();
            $table->string('open_image')->nullable();
            $table->string('close_image')->nullable();
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
        Schema::dropIfExists('shifts');
    }
}
