<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Http\Controllers\Auth\RegisteredUserController as BaseRegistrationController;
use App\Models\AccountSettings;
use App\Models\Shop;
use App\Models\User;
use Chatify\Facades\ChatifyMessenger as Chatify;
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
	private $accountSettings;

	public function create()
	{
		return view('auth.customer.register');
	}

	public function store(Request $request)
	{
		// dd($request);
		$request->validate([
			'firstname' => ['required', 'string', 'max:255'],
			'lastname' => ['required', 'string', 'max:255'],
			'contact' => ['required', 'numeric', 'digits:11'],
			'birthday' => ['required', 'string', 'date', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255'],
			'password' => [
				'required', 'confirmed', Rules\Password::min(8)
					->letters()
					->mixedCase()
					->numbers()
					->symbols()
					->uncompromised(3),
			],
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

		try {
			$id = $this->generateUserID();

			DB::beginTransaction();
			$this->user = User::create([
				'userId' => $id,
				'firstname' => $request->firstname,
				'lastname' => $request->lastname,
				'contact' => $request->contact,
				'birthday' => $request->birthday,
				'two_factor_secret' => null,
				'is_2fa_enabled' => User::TWO_FA_DISABLED,
				'is_business' => User::IS_CUSTOMER,
				'email' => $request->email,
				'password' => Hash::make($request->password),
			]);

			$this->accountSettings = AccountSettings::create([
				'user_id' => $this->user->id,
				'profile_img' => null,
			]);



			DB::commit();

			event(new Registered($this->user));
			Auth::login($this->user);
			Chatify::makeInFavorite(Shop::first()->user_id, 1);

			return redirect()->route('customer.home.index');
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
	}
}
