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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->string('password');
            $table->string('profile_pic')->default('default.png');
            $table->integer('status')->default('1');
            $table->integer('notification_status')->default('1');
            $table->integer('type')->default('2');
            $table->string('google_id');
            $table->string('facebook_id');
            $table->string('login_type');
            $table->string('referral_code');
            $table->string('firebase');
            $table->string('currency');
            $table->string('wallet');
            $table->text('token');
            $table->integer('is_verified');
            $table->text('server_key');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
