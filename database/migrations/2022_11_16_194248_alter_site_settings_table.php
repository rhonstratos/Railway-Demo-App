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
			$table->longText('site_color_theme')->nullable()->default(null)->change();
			$table->longText('placeholders')->nullable()->default(null)->change();
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
			$table->longText('site_color_theme')->change();
			$table->longText('placeholders')->change();
		});
	}
};
