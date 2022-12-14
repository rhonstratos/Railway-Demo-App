<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('carts', function (Blueprint $table) {
			$table->dropForeign(['product_id']);
			$table->dropIndex('carts_product_id_unique');
			$table->dropColumn('product_id');
		});
		if (!Schema::hasColumn('carts', 'product_id')) {
			Schema::table('carts', function (Blueprint $table) {
				$table->foreignId('product_id')->constrained();
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('carts', function (Blueprint $table) {
			$table->unique('product_id');
		});
	}
};
