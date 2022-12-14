<?php

namespace App\Http\Controllers\QRCode;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use PragmaRX\Google2FA\Google2FA;

class Google2FAController extends Controller
{
	public function __construct(
		private GenerateQRCode $generateQRCode
	) {
	}

	public function generateKey()
	{
		return $this->google2fa->generateSecretKey();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$this->generateQRCode->setEmail(Auth::user()->email);
		$key = $this->generateQRCode->getQrCodeUrl();
		$qrcode = $this->generateQRCode->getQrCode($key);
		$key = Crypt::encryptString($key);
		$qrcode = 'data:image/svg+xml;base64,' . base64_encode($qrcode);
		return view('pages.test')
			->with(compact('qrcode'))
			->with(compact('key'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Google2FA $g2fa, Request $request)
	{
		if (!$g2fa->verifyKey(
			Auth::user()->google2fa_secret,
			$request->one_time_password
		)) {
			return redirect(route('google2fa.index'));
		}
		Session::put('auth.two_factor_confirmed_at', now());

		return redirect(route('dashboard'));
	}
}
