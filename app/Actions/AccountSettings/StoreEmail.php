<?php

namespace App\Actions\AccountSettings;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class StoreEmail extends Store
{
	public function execute(string $email)
	{
		$user = Auth::user();
		$user->email = $email;
		$user->save();
	}
}
