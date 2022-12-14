<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AccountSettings;
use App\Models\Products;
use App\Models\Shop;
use App\Models\SiteSettings;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run()
	{
		$id = (string) uniqid();
		$user = User::create([
			'userId' => $id,
			'firstname' => 'Admin',
			'lastname' => 'User',
			'contact' => '00000000000',
			'birthday' => now(),
			'two_factor_secret' => null,
			'is_2fa_enabled' => User::TWO_FA_DISABLED,
			'is_business' => User::IS_BUSINESS,
			'email' => 'admin@rectify.test',
			'password' => Hash::make('adminpassword'),
		]);

		$shop = Shop::create([
			'user_id' => $user->id,
			'name' => 'Test Shop Name',
			'description' => 'Test Sample shop description',
			'tagline' => 'Test Sample shop tagline',
			'address' => [
				'street' => fake()->streetAddress(),
				'brgy' => fake()->city(),
				'city' => fake()->city(),
				'province' => fake()->city(),
				'zip' => fake()->postcode(),
			],
			'appointment_settings' => [
				'operatingHours' => [
					'start' => Carbon::createFromFormat('h:i A', '08:00 AM'),
					'end' => Carbon::createFromFormat('h:i A', '05:00 PM')
				],
				'operatingDays' => [
					Shop::WEEK_MONDAY => true,
					Shop::WEEK_TUESDAY => true,
					Shop::WEEK_WEDNESDAY => true,
					Shop::WEEK_THURSDAY => true,
					Shop::WEEK_FRIDAY => true,
					Shop::WEEK_SATURDAY => true,
					Shop::WEEK_SUNDAY => true,
				],
				'accomodation_slots' => 2,
				'accomodation_interval' => [
					'hours' => 1,
					'minutes' => 0
				],
			],
			'shop_settings' => [
				'interface' => [
					'colors' => [
						fake()->colorName(),
						fake()->colorName(),
						fake()->colorName(),
						fake()->colorName(),
						fake()->colorName(),
					],
				],
			],
			'services' => [
				'Mobile Repair' => true,
				'Computer Repair' => true,
				'Data Recovery' => true,
				'Accessories Repair' => true,
				'Gadget Customization' => true,
				'Application Setup' => true,
			],
			'contacts' => [
				'landline' => null,
				'mobile' => null,
				'facebook' => null,
			],
			'googleMaps' => null,
			'googleMaps_embed' => null,
			// 'two_factor_secret' => null,
			// 'is_2fa_enabled' => 0,
		]);

		$image_fullPath = resource_path() . '/assets/images/master/placeholders/poggy.png';

		Storage::disk('public')
			->put('users/' . $user->userId . '/images/profile/poggy.png', File::get($image_fullPath));
		$acocunt_settings = AccountSettings::create([
			'user_id' => $user->id,
			'profile_img' => 'poggy.png',
		]);

		$siteSettings = SiteSettings::create([
			'site_color_theme' => 'interface-color1',
			'site_color_hex' => '#FF9595',
			'placeholders' => null,
			'gallery' => [
				'gallery_title' => (array)[1 => null, 2 => null, 3 => null, 4 => null, 5 => null],
				'gallery_desc' => (array)[1 => null, 2 => null, 3 => null, 4 => null, 5 => null],
				'gallery_img' => (array)[1 => null, 2 => null, 3 => null, 4 => null, 5 => null],
			],
		]);

		// foreach (range(1, 100) as $product) {
		// 	$name = fake()->word();
		// 	while (Products::where('name', $name)->exists()) {
		// 		$name = fake()->word();
		// 	}
		// 	$prod = Products::factory(1)->create(['name' => $name])->first();
		// 	$prod->setInventory((int)15);
		// 	$id = $prod->productId;
		// 	foreach ([
		// 		'woggy_alright.png',
		// 		'woggy_cool.png',
		// 		'woggy_angry.png',
		// 		'woggy_complain.gif',
		// 	] as $file) {
		// 		$prod_image_fullPath = resource_path() . '/assets/images/master/factory/' . $file;

		// 		Storage::put('products/' . $id . '/' . $file, File::get($prod_image_fullPath));
		// 	}
		// }
	}
}
