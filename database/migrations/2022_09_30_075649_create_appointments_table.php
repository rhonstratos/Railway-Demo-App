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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->longText('appointmentId');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('shop_id')->constrained();
            $table->longtext('alt_contact')->nullable();
            $table->longText('product_details');
            $table->longText('concern');
            $table->longText('appointment_date_time');
            $table->longText('appointment_status')->nullable();
            $table->longText('repair_status')->nullable();
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
        Schema::dropIfExists('appointments');
    }
};
