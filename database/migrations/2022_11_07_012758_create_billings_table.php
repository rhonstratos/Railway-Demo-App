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
		Schema::create('billings', function (Blueprint $table) {
			$table->id();
			$table->string('billingId')->unique();
			$table->foreignId('appointment_id')->constrained();
			$table->longText('repair_remarks');
			$table->string('repair_cost');
			$table->longText('items');
			$table->string('total');
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
		Schema::dropIfExists('billings');
	}
};
