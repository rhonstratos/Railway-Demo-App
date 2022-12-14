<?php

namespace App\Actions\Business\AccountSecurity;

use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class StoreNewPassword
{
	public function execute($newPassword)
	{
		$auth = Auth::user();
		$user = User::findOrFail($auth->id);
		$user->password = Hash::make($newPassword);
		//dump($user->save());
		$user->save();
	}
}
