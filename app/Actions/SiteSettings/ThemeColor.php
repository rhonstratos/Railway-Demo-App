<?php

namespace App\Actions\SiteSettings;

use App\Http\Requests\SiteSettings as FormRequest;
use App\Models\SiteSettings;

class ThemeColor
{
	public function execute(FormRequest\ThemeColor $request)
	{
		$settings = SiteSettings::firstOrFail();

		$settings->site_color_theme = config('cms.site_settings.theme_color')[$request->theme_color]['class'];
		$settings->site_color_hex = config('cms.site_settings.theme_color')[$request->theme_color]['hex'];
		$settings->save();
	}
}
