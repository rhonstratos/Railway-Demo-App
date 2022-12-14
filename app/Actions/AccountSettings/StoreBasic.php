<?php

namespace App\Actions\AccountSettings;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class StoreBasic extends Store
{
	public function execute(array $val)
	{
		$imgFile = null;
		$file = false;
		$user = Auth::user();

		if (Arr::exists($val, 'user_img')) {
			$imgFile = $val['user_img'];
			$file = true;
		}
		// if ($file && !$this->deleteImg($user->userId)) {
		// 	throw new \Exception('failed to delete directory');
		// }
		$user->firstname = $val['first_name'];
		$user->lastname = $val['last_name'];
		$user->contact = $val['contact'];
		$user->address = $val['address'];
		$acc_settings = $user
			->accountSettings()
			->firstOrFail();
		if ($file) {
			$acc_settings->profile_img = $this->saveImg($user->userId, $imgFile);
		}
		$user->save();
		$acc_settings->save();

		// if ($file && !$this->saveImg($user->userId, $imgFile)) {
		// 	throw new \Exception('failed to store image');
		// }
	}
}
