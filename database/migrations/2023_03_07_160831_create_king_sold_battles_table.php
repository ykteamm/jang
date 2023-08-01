<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKingSoldBattlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('king_sold_battles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_uid');
            $table->foreignId('accept_uid')->nullable();
            $table->longText('offer_comment')->nullable();
            $table->longText('accept_comment')->nullable();
            $table->double('offer_count',8,2)->nullable();
            $table->double('accept_count',8,2)->nullable();
            $table->integer('win')->nullable();
            $table->integer('lose')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('start');
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
        Schema::dropIfExists('king_sold_battles');
    }
}
