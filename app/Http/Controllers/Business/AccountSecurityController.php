<?php

namespace App\Http\Controllers\Business;

use App\Actions\AccountSettings\GenerateNew2FA;
use App\Actions\AccountSettings\Store2FA;
use App\Actions\Business\AccountSecurity\StoreNewEmail;
use App\Actions\Business\AccountSecurity\StoreNewPassword;
use App\Http\Controllers\AccountSettingsController as BaseController;
use App\Http\Requests\Business\AccountSecurity\StorePassword;
use App\Models\User;
use App\Traits\Business\AuthData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PragmaRX\Google2FA\Google2FA;

class AccountSecurityController extends BaseController
{
	use AuthData;
	public function __construct(
		private Google2FA        $google2fa,
		private GenerateNew2FA   $generateNew2FA,
		private StoreNewEmail    $storeNewEmail,
		private StoreNewPassword $storeNewPassword,
		private Store2FA $store2FA,
	) {
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('pages.shop.account-security')
			->with($this->getAuthShopData());
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

	public function verifyPass(Request $request)
	{
		return Hash::check($request->pass, Auth::user()->password);
	}

	public function storeNewPassword(StorePassword $request)
	{
		if (!Hash::check($request->current_password, Auth::user()->password)) {
			return redirect()->back()->withErrors([
				'fail' => 'The password you entered is incorrect, please try again.'
			]);
		}
		if (Hash::check($request->new_password, Auth::user()->password)) {
			return redirect()->back()->withErrors([
				'fail' => 'The password you entered is not new, please try again.'
			]);
		}

		try {
			DB::beginTransaction();
			$this->storeNewPassword->execute($request->new_password);
			DB::commit();
			return redirect()->back()
				->with([
					'success' => 'You have successfully save your new password.'
				]);
		} catch (\Exception $err) {
			DB::rollBack();
			// dump($err);
			return redirect()->back()->withErrors([
				'fail' => 'The password you entered is incorrect, please try again.'
			]);
		}
	}

	public function storeNewEmail(Request $request)
	{
		if (!Hash::check($request->password, Auth::user()->password)) {
			return redirect()->back()->withErrors([
				'fail' => 'The password you entered is incorrect, please try again.'
			]);
		}

		try {
			DB::beginTransaction();
			$this->storeNewEmail->execute($request->newEmail);
			DB::commit();
			return redirect()->back()
				->with([
					'success' => 'You have successfully save your new email.'
				]);
		} catch (\Exception $err) {
			DB::rollback();
			return redirect()->back()->withErrors([
				'fail' => 'An unexpected error occurred, please try again.'
			]);
		}
		return Hash::check($request->pass, Auth::user()->password);
	}

	public function store2FA(Request $request)
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
