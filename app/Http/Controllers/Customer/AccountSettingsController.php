<?php

namespace App\Http\Controllers\Customer;

use App\Actions\AccountSettings as Actions;
use App\Actions\AccountSettings\GenerateNew2FA;
use App\Actions\AccountSettings\Store2FA;
use App\Actions\AccountSettings\StoreEmail;
use App\Actions\AccountSettings\StorePassword;
use App\Http\Controllers\AccountSettingsController as BaseController;
use App\Http\Requests\AccountSecurity\NewPassword;
use App\Http\Requests\Customer\AccountSettings\NewEmail;
use App\Models\User;
use App\Traits\Business\AuthData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PragmaRX\Google2FA\Google2FA;

class AccountSettingsController extends BaseController
{
	use AuthData;

	public function __construct(
		private Google2FA        $google2fa,
		private GenerateNew2FA $generateNew2FA,
		private StoreEmail     $storeEmail,
		private StorePassword  $storePassword,
		private Store2FA $store2FA,
		private Actions\StoreBasic $storeBasic,
		private Actions\StoreAuth $storeAuth
	) {
	}

	public function index()
	{
		return view('pages.client.account-settings')
			->with($this->getAuthUserData());
	}

	public function create()
	{
		$generated = $this->generateNew2FA->execute();

		return response()->json([
			'qr' => view(
				'components.qrcode',
				['qrcode' => $generated['qrcode']]
			)->render(),
			'string' => Crypt::encryptString($generated['key']),
		]);
	}

	public function validatePassword(Request $request)
	{
		return Hash::check($request->password, Auth::user()->password)
			? response()->json(true, 200)
			: response()->json(['fail' => 'password is not valid, please try again'], 418);
	}

	public function storeNewEmail(NewEmail $request)
	{
		try {
			DB::beginTransaction();
			$this->storeEmail->execute($request->new_email);
			DB::commit();
			return view('pages.client.account-settings')
				->with([
					'success' => 'You have successfully changed your email.'
				])
				->with($this->getAuthUserData());
		} catch (\Exception $err) {
			DB::rollBack();
			//dd($err);
			return redirect()->back()->withErrors([
				'fail' => 'An unexpected error occurred, please try again.'
			]);
		}
	}
	public function storeNewPassword(NewPassword $request)
	{
		if (!Hash::check($request->current_password, Auth::user()->password)) {
			return redirect()->back()
				->withErrors([
					'fail' => 'You have entered your current password wrong, please try again.'
				]);
		}

		try {
			DB::beginTransaction();
			$this->storePassword->execute($request->new_password);
			DB::commit();
			return view('pages.client.account-settings')
				->with([
					'success' => 'You have successfully changed your email.'
				])
				->with($this->getAuthUserData());
		} catch (\Exception $err) {
			DB::rollBack();
			//dd($err);
			return redirect()->back()->withErrors([
				'fail' => 'An unexpected error occurred, please try again.'
			]);
		}
	}
	public function storeNew2FA(Request $request)
	{
		if (!$this->google2fa->verifyKey(
			Auth::user()->accountSettings->google_2fa_key_temp,
			$request->gAuth
		)) {
			return redirect()->back()->with([
				'fail-2fa' => 'The 6 digit code you entered was invalid, please try again.'
			]);
		}

		try {
			DB::beginTransaction();
			$this->store2FA->execute();
			DB::commit();

			return redirect()->back()->with([
				'success-2fa' => 'Google 2 Factor Authentication Enabled'
			]);
		} catch (\Exception $err) {
			DB::rollBack();
			//dd($err);
			return redirect()->back()->with([
				'fail-2fa' => 'There was an unexpected error, please try again.',
			]);
		}
	}
}
