<?php

namespace App\Actions\AccountSettings;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StoreAuth extends Store
{
	public function execute(array $val)
	{
		$user = Auth::user();
		// dd($val,Arr::exists($val, 'email'),Arr::exists($val, 'password'));
		if (Arr::exists($val, 'email')) {
			$this->editEmail($user, $val);
		}
		if (Arr::exists($val, 'password')) {
			$this->editPassword($user, $val);
		}
		$user->save();
	}
	private function editEmail(User $user, array $val)
	{
		$user->email = $val['email'];
	}
	private function editPassword(User $user, array $val)
	{
		$user->password = Hash::make($val['password']);
	}
}
