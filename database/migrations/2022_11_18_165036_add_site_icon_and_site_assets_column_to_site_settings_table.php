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
		Schema::table('site_settings', function (Blueprint $table) {
			$table->longText('site_icon')->nullable()->default(null);
			$table->longText('site_assets')->nullable()->default(null);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('site_settings', function (Blueprint $table) {
			$table->dropColumn('site_icon');
			$table->dropColumn('site_assets');
		});
	}
};
