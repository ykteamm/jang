<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirewallSoldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firewall_solds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->foreignId('user_id');
            $table->foreignId('pharmcy_id');
            $table->foreignId('medicine_id');
            $table->integer('number');
            $table->integer('price');
            $table->integer('in_or_out');
            $table->integer('active')->default(0);
            $table->foreignId('confirm_by')->nullable();
            $table->string('phone')->nullable();
            $table->string('client_name')->nullable();
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
        Schema::dropIfExists('firewall_solds');
    }
}
