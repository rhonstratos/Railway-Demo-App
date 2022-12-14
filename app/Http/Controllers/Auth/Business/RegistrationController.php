<?php

namespace App\Http\Controllers\Auth\Business;

use App\Http\Controllers\Auth\RegisteredUserController as BaseRegistrationController;
use App\Models\AccountSettings;
use App\Models\Shop;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\ValidationException;
use ParagonIE\CipherSweet\Exception\BlindIndexNotFoundException;

class RegistrationController extends BaseRegistrationController
{
	private $user;

	private $shop;

	private $accountSettings;

	public function create()
	{
		return view('auth.business.register');
	}

	public function store(Request $request)
	{

		$request->validate([
			'firstname' => ['required', 'string', 'max:255'],
			'lastname' => ['required', 'string', 'max:255'],
			'contact' => ['required', 'numeric', 'digits:11'],
			'birthday' => ['required', 'string', 'date', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255'],
			'password' => ['required', 'confirmed', Rules\Password::defaults()],
			'shop_img' => [
				'required',
				File::image()
					->min(20)
					->max(12 * 1024)
					->dimensions(
						Rule::dimensions()
							->maxWidth(1000)
							->maxHeight(500)
					),
			],
			'shop_name' => ['required', 'string'],
			'shop_description' => ['required', 'string'],
			'street' => ['required', 'string'],
			'brgy' => ['required', 'string'],
			'city' => ['required', 'string'],
			'province' => ['required', 'string'],
			'zip' => ['required', 'string'],
		]);

		try {
			$userInfo = User::whereBlind('email', 'email_index', (string) $request->email)->exists();
			if ($userInfo) {
				throw ValidationException::withMessages([
					'email' => 'The email provided is already registered.',
				]);
			}
		} catch (BlindIndexNotFoundException $ignored) {
		}

		if (!$request->file('shop_img')->isValid()) {
			throw ValidationException::withMessages([
				'image' => 'The selected image is not valid.',
			]);
		}

		try {
			$id = $this->generateUserID();
			$image = $request->file('shop_img');
			$imageStatus = $image->storeAs('public/users/' . $id . '/images/profile', $image->getClientOriginalName());

			DB::beginTransaction();
			$this->user = User::create([
				'userId' => $id,
				'firstname' => $request->firstname,
				'lastname' => $request->lastname,
				'contact' => $request->contact,
				'birthday' => Carbon::create($request->birthday),
				'two_factor_secret' => null,
				'is_2fa_enabled' => User::TWO_FA_DISABLED,
				'is_business' => User::IS_BUSINESS,
				'email' => $request->email,
				'password' => Hash::make($request->password),
			]);

			$this->shop = Shop::create([
				'user_id' => $this->user->id,
				'name' => $request->shop_name,
				'description' => $request->shop_description,
				'tagline' => null,
				'address' => [
					'street' => $request->street,
					'brgy' => $request->brgy,
					'city' => $request->city,
					'province' => $request->province,
					'zip' => $request->zip,
				],
				'appointment_settings' => [
					'operatingHours' => [
						'start' => Carbon::createFromFormat('h:i A', '09:00 AM'),
						'end' => Carbon::createFromFormat('h:i A', '05:00 PM')
					],
					'operatingDays' => [
						Shop::WEEK_MONDAY,
						Shop::WEEK_TUESDAY,
						Shop::WEEK_WEDNESDAY,
						Shop::WEEK_THURSDAY,
						Shop::WEEK_FRIDAY,
						Shop::WEEK_SATURDAY,
						Shop::WEEK_SUNDAY,
					],
					'accomodation_slots' => 2,
					'accomodation_interval' => [
						'hours' => 1,
						'minutes' => 0
					],
				],
				'shop_settings' => null,
				'services' => [
					'Computer Repair',
					'Laptop Repair',
					'Mobile Repair',
					'Console Repair',
					'IoT Repair',
				],
				'contacts' => [
					'landline' => null,
					'mobile' => null,
					'facebook' => null,
				],
				'googleMaps' => null,
				'googleMaps_embed' => null,
			]);

			$this->accountSettings = AccountSettings::create([
				'user_id' => $this->user->id,
				'profile_img' => $image->getClientOriginalName(),
			]);
			DB::commit();
		} catch (\Exception $err) {
			DB::rollBack();
			$error = [
				'message' => $err->getMessage(),
				'code' => $err->getCode(),
				'file' => $err->getFile(),
				'line' => $err->getLine(),
			];
			event(new \App\Events\FailedAction($this::class, $error));
			throw ValidationException::withMessages([
				'error 500' => 'An error has occured, please try again.',
				// 'message'=>$e->getMessage()

			]);
		}

		if ($imageStatus == false) {
			// new event: error file upload after registration
		}

		event(new Registered($this->user));

		Auth::login($this->user);
		// redirect to mainpage
		return redirect()->route('business.dashboard.index');
	}
}
