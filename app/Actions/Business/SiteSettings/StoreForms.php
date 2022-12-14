<?php

namespace App\Actions\Business\SiteSettings;

use App\Http\Requests\Business\ShopSettings as Forms;
use App\Models\SiteSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreForms
{
	public function formOne(Forms\Form1 $request)
	{
		$user = Auth::user();
		$shop = $user->shop;
		$settings = $user->accountSettings;
		$userId = $user->userId;

		$shop->name = $request->shop_name;
		$shop->tagline = $request->tagline;

		if ($request->shop_img) {
			$image = $request->file('shop_img');
			$userPath = "public/users/{$userId}/images/profile";
			$settings->profile_img = pathinfo($image->store($userPath))['basename'];
		}

		$shop->save();
		$settings->save();
	}
	public function formTwo(Forms\Form2 $request)
	{
		$user = Auth::user();
		$shop = $user->shop;

		$newAddress = [
			'street' => $request->street,
			'province' => $request->province,
			'city' => $request->city,
			'brgy' => $request->brgy,
			'zip' => $request->zip,
		];
		$shop->address = $newAddress;
		$shop->googleMaps_embed = $request->googleMaps_embed;
		$shop->googleMaps = $request->googleMaps ? $request->googleMaps : null;

		$shop->save();
		//dump($request->toArray());
	}
	public function formThree(Forms\Form3 $request)
	{
		$user = Auth::user();
		$shop = $user->shop;

		$shop->description = $request->shop_desc;
		$shop->contacts = $request->shop_contacts;
		$shop->about_us = $request->shop_aboutUs;
		$shop->socials = $request->shop_socials;

		//dump($shop->save());
		$shop->save();
	}
	public function formFour(Forms\Form4 $request)
	{
		// dd($request->toArray());
		$user = Auth::user();
		$shop = $user->shop;

		$newOperatingDays = $shop->appointment_settings['operatingDays'];

		foreach ($newOperatingDays as $key => $days) {
			if (isset($request->operating_days[$key])) {
				$newOperatingDays[$key] = true;
				continue;
			}
			$newOperatingDays[$key] = false;
		}
		#dd(Carbon::createFromFormat('h:i A', $request->time_opening));

		$newAppointmentSettings = [
			'operatingHours' => [
				'start' => $request->time_opening,
				'end' => $request->time_closing
			],
			'operatingDays' => $newOperatingDays,
			'accomodation_slots' => $request->time_interval,
			'accomodation_interval' => [
				'hours' => $request->time_interval_hour,
				'minutes' => $request->time_interval_minute
			]
		];
		# dd($newAppointmentSettings);
		$shop->appointment_settings = $newAppointmentSettings;
		#dd($shop->appointment_settings);

		//dump($shop->save());
		$shop->save();
	}

	public function formFive(Forms\Form5 $request)
	{
		$user = Auth::user();
		$shop = $user->shop;

		$newServices = $shop->services;

		$newServices['Mobile Repair'] = isset($request->services['Mobile Repair']) ? true : false;
		$newServices['Computer Repair'] = isset($request->services['Computer Repair']) ? true : false;
		$newServices['Data Recovery'] = isset($request->services['Data Recovery']) ? true : false;
		$newServices['Accessories Repair'] = isset($request->services['Accessories Repair']) ? true : false;
		$newServices['Gadget Customization'] = isset($request->services['Gadget Customization']) ? true : false;
		$newServices['Application Setup'] = isset($request->services['Application Setup']) ? true : false;

		$shop->services = $newServices;
		$shop->save();
	}
	public function formSix(Forms\Form6 $request)
	{
		$user = Auth::user();
		$shop = $user->shop;

		$shop->payment_method = $request->payment_method;
		$shop->save();
	}
	public function formSeven(Forms\Form7 $request)
	{
		$user = Auth::user();
		$shop = $user->shop;

		$shop->transfer_method = $request->transfer_method;
		$shop->save();
	}
	public function formEight(Forms\Form8 $request)
	{

		$user = Auth::user();
		$shop = $user->shop;

		$shopPath = 'shop/' . $user->userId;

		$newShopSettings = [
			'gcash_name' => $request->gcash_name,
			'gcash_num' => $request->gcash_num,
			'paymaya_name' => $request->paymaya_name,
			'paymaya_num' => $request->paymaya_num,
		];
		$newShopSettings['gcash_img'] = !is_null($request->gcash_img)
			? pathinfo($request->file('gcash_img')->store($shopPath))['basename']
			: null;

		$newShopSettings['paymaya_img'] = !is_null($request->paymaya_img)
			? pathinfo($request->file('paymaya_img')->store($shopPath))['basename']
			: null;

		$shop->payment_settings = $newShopSettings;

		//dump($shop->save());
		$shop->save();
	}
	public function formNine(Forms\Form9 $request)
	{
		$user = Auth::user();
		$shop = $user->shop;

		$shop->faqs = $request->faq;

		//dump($shop->save());
		$shop->save();
	}
	public function form10(Forms\Form10 $request)
	{
		// dump($request->file('gallery_img')[1]);
		// dd($request->toArray());
		$settings = SiteSettings::firstOrFail();
		$newGallery = (array) [
			'gallery_title' => (array) [1 => null, 2 => null, 3 => null, 4 => null, 5 => null],
			'gallery_desc' => (array) [1 => null, 2 => null, 3 => null, 4 => null, 5 => null],
			'gallery_img' => (array) [1 => null, 2 => null, 3 => null, 4 => null, 5 => null],
		];
		// dd($newGallery['gallery_title']);
		foreach (range(1, 5) as $i) {
			// dd($newGallery);
			// dd($i);
			$newGallery['gallery_title'][$i] =
				isset($request->gallery_title[$i])
				? $request->gallery_title[$i]
				: $settings->gallery['gallery_title'][$i];

			$newGallery['gallery_desc'][$i] =
				isset($request->gallery_desc[$i])
				? $request->gallery_desc[$i]
				: $settings->gallery['gallery_desc'][$i];

			$imgPath = 'public/master/gallery';
			$newGallery['gallery_img'][$i] =
				isset($request->file('gallery_img')[$i])
				? pathinfo($request->file('gallery_img')[$i]->store($imgPath))['basename']
				: $settings->gallery['gallery_img'][$i];
		}

		$settings->gallery = $newGallery;
		$settings->save();
	}
	public function form10Delete(Forms\Form10 $request)
	{
		$settings = SiteSettings::firstOrFail();
		$newGallery = $settings->gallery;
		$i = $request->delete;

		$newGallery['gallery_title'][$i] = null;
		$newGallery['gallery_desc'][$i] = null;
		$newGallery['gallery_img'][$i] = null;

		$settings->gallery = $newGallery;
		$settings->save();
	}
}
