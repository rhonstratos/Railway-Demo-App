<?php

namespace App\Actions\AccountSettings;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class Store
{
	public function deleteImg($userId)
	{
		$userPath = "users/{$userId}/images/profile";

		return Storage::disk('public')
			->deleteDirectory($userPath);
	}

	public function saveImg($userId, $img)
	{
		$userPath = "public/users/{$userId}/images/profile";
		return pathinfo($img->store($userPath))['basename'];
	}
}
