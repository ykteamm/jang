<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopshiriqTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topshiriq', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->date('first_date');
            $table->date('end_date');
            $table->integer('number');
            $table->integer('star');
            $table->integer('status')->default(1);
            $table->string('key');
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
        Schema::dropIfExists('topshiriq');
    }
}
