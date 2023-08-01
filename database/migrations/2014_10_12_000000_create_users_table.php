<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('users', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('first_name');
        //     $table->string('last_name');
        //     $table->date('birth_date');
        //     $table->string('lat');
        //     $table->string('long');
        //     $table->string('pharmacy');
        //     $table->string('phone_number');
        //     $table->string('password');
        //     $table->string('pass');
        //     $table->double('account',8,2)->default(0);
        //     $table->double('cashback',8,2)->default(0);
        //     $table->rememberToken();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
