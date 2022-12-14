<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('userId')->unique();
            $table->longText('firstname');
            $table->longText('lastname');
            $table->longText('contact');
            $table->longText('birthday');
            $table->longText('two_factor_secret')->nullable();
            $table->boolean('is_2fa_enabled');
            $table->boolean('is_business');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->longText('password');
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
};
