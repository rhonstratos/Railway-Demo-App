<?php

namespace App\Actions\AccountSettings;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Store2FA extends Store
{
	public function execute()
	{
		$user = User::find(Auth::id());
		$settings = $user->accountSettings;
		$user->google2fa_secret = $settings->google_2fa_key_temp;
		$settings->google_2fa_key_temp = null;
		$settings->push();
		$user->is_2fa_enabled = true;
		$user->save();
	}
}
