<?php

namespace App\Traits\Business;

use App\Models\AccountSettings;
use App\Models\Shop;
use App\Models\SiteSettings;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait AuthData
{
	public function getAuthUserData(): array
	{
		// loads all data of the authenticated user
		$user = Auth::user()->load(['shop.product']);
		$accs = $user->accountSettings;
		$user_id = $user->userId;
		$shop = Shop::first();
		// $site_settings = SiteSettings::first();
		$addresses = $shop->address;
		$user_data = [
			'shop' => $shop,
			// 'site_settings' => $site_settings,
			'shop_address' => "{$addresses['street']}, {$addresses['brgy']}, {$addresses['city']}, {$addresses['province']}, {$addresses['zip']}",
			'user' => $user,
			'full_name' => $user->firstname . ' ' . $user->lastname,
		];
		$profile_img_path = $accs->profile_img
			? asset('storage/users/' . $user_id . '/images/profile/' . $accs->profile_img)
			: asset('assets/master/placeholders/poggy.png');

		$user_data['profile_img_path'] = $profile_img_path;
		$user_data['shop_img'] = asset('storage/users/' . $shop->user->userId . '/images/profile/' . $shop->user->accountSettings->profile_img);

		return $user_data;
	}
	public function getGuestUserData(): array
	{
		// loads all data of the authenticated user
		// $user = Auth::user()->load(['shop.product']);
		// $accs = $user->accountSettings;
		// $user_id = $user->userId;
		$shop = Shop::first();
		// $site_settings = SiteSettings::first();
		$addresses = $shop->address;
		$user_data = [
			'shop' => $shop,
			// 'site_settings' => $site_settings,
			'shop_address' => "{$addresses['street']}, {$addresses['brgy']}, {$addresses['city']}, {$addresses['province']}, {$addresses['zip']}",
			// 'user' => $user,
			// 'full_name' => $user->firstname . ' ' . $user->lastname,
		];
		$profile_img_path =
			asset('assets/master/placeholders/poggy.png');

		$user_data['profile_img_path'] = $profile_img_path;

		return $user_data;
	}
	public function getAuthShopData(): array
	{
		// loads all data of the authenticated user
		$user = Auth::user()->load(['shop']);
		$accs = $user->accountSettings;
		$shop = $user->shop;

		$user_id = $user->userId;

		$user_data = [
			'user' => $user,
			'accountSettings' => $accs,
			'shop' => $shop,
			'full_name' => $user->firstname . ' ' . $user->lastname,
		];

		$profile_img_path = $accs->profile_img
			? asset('storage/users/' . $user_id . '/images/profile/' . $accs->profile_img)
			: asset('assets/master/placeholders/poggy.png');

		$user_data['profile_img_path'] = $profile_img_path;

		return $user_data;
	}
}
