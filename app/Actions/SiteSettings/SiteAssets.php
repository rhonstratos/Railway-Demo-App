<?php

namespace App\Actions\SiteSettings;

use App\Http\Requests\SiteSettings as FormRequest;
use App\Models\SiteSettings;

class SiteAssets
{
	public function execute(FormRequest\AssetsForm $request)
	{
		// dd($request->toArray());
		$assetPath = 'public/master/assets';
		$settings = SiteSettings::firstOrFail();

		$newIcons = [];
		$newSplash = [];

		foreach ($request->icon as $i => $icon) {
			$newIcons[$i] = pathinfo($icon->store($assetPath))['basename'];
		}
		foreach ($request->splash as $i => $splash) {
			$newSplash[$i] = pathinfo($splash->store($assetPath))['basename'];
		}

		if ($request->site_name) {
			$settings->site_name = $request->site_name;
		}

		$settings->site_icon = pathinfo($request->site_logo->store($assetPath))['basename'];
		$settings->site_assets = array_merge($newIcons, $newSplash);
		$settings->save();
	}
}
