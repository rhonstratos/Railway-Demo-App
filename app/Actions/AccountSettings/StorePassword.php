<?php

namespace App\Actions\AccountSettings;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StorePassword extends Store
{
	public function execute(string $password)
	{
		$user = Auth::user();
		$user->password = Hash::make($password);
		$user->save();
	}
}
