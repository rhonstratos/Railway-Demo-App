<?php

namespace App\Actions\AccountSettings;

use App\Http\Controllers\QRCode\GenerateQRCode;
use App\Models\AccountSettings;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GenerateNew2FA extends Store
{
	public function __construct(
		private GenerateQRCode $generateQRCode
	) {
	}
	public function execute(): array
	{
		$this->generateQRCode->setEmail(Auth::user()->email);
		$qrURL = $this->generateQRCode->getQrCodeUrl();
		$qrcode = $this->generateQRCode->getQrCode($qrURL);
		$key = $this->generateQRCode->getSecretKey();

		$settings = AccountSettings::findOrFail(Auth::id());
		$settings->google_2fa_key_temp = $key;
		$settings->save();
		$qrcode = 'data:image/svg+xml;base64,' . base64_encode($qrcode);
		return [
			'key' => $key,
			'qrcode' => $qrcode,
		];
	}
}
