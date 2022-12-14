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
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->longText('name');
            $table->longText('description')->nullable();
            $table->longText('tagline')->nullable();
            $table->longText('address')->nullable();
            $table->longText('appointment_settings')->nullable();
            $table->longText('shop_settings')->nullable();
            $table->longText('services')->nullable();
            $table->longText('contacts')->nullable();
            $table->longText('googleMaps')->nullable();
            $table->longText('googleMaps_embed')->nullable();
            // $table->string('two_factor_secret', 255)->nullable();
            // $table->boolean('is_2fa_enabled');
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
        Schema::dropIfExists('shops');
    }
};
