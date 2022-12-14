<?php

namespace App\Actions\Business\AccountSecurity;

use App\Models\User;
use Auth;

class StoreNewEmail
{
	public function execute($newEmail)
	{
		$auth = Auth::user();
		$user = User::findOrFail($auth->id);
		$user->email = $newEmail;
		$user->save();
	}
}
