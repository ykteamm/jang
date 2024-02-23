<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopshiriqUserPlanWeekTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topshiriq_user_plan_week', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->integer('star');
            $table->integer('plan_week');
            $table->integer('status')->default(1);
            $table->integer('success')->nullable();
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
        Schema::dropIfExists('topshiriq_user_plan_week');
    }
}
