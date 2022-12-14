<?php

namespace App\Providers;

use App\Models\SiteSettings;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		try {
			$site_settings = SiteSettings::first();
			$icons = [
				'57x57',
				'60x60',
				'72x72',
				'76x76',
				'96x96',
				'114x114',
				'152x152',
				'180x180',
				'192x192',
				'256x256',
				'384x384',
				'512x512',
			];
			$splash = [
				'640x1136',
				'750x1334',
				'828x1792',
				'1125x2436',
				'1242x2208',
				'1242x2688',
				'1536x2048',
				'1668x2224',
				'1668x2388',
				'2048x2732',
			];
			if (!is_null($site_settings->site_assets)) {
				foreach ($site_settings->site_assets as $i => $assets) {
					if (Str::contains($i, $icons)) {
						Config::set('laravelpwa.manifest.icons.' . $i . '.path', asset('storage/master/assets/' . $assets));
					}
					if (Str::contains($i, $splash)) {
						Config::set('laravelpwa.manifest.splash' . $i . '.path', asset('storage/master/assets/' . $assets));
					}
				}
			}
			if (!is_null($site_settings->site_name)) {
				Config::set('app.name', $site_settings->site_name);
			}
			View::share('site_settings', $site_settings);
		} catch (\Illuminate\Database\QueryException $err) {
			$site_settings = collect(['site_color_theme', 'site_color_hex']);
			$site_settings->site_color_theme = config('cms.site_settings.theme_color.color1.class');
			$site_settings->site_color_hex = config('cms.site_settings.theme_color.color1.class');
			View::share('site_settings', $site_settings);
		}
	}
}
