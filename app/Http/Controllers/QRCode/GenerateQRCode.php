<?php

namespace App\Http\Controllers\QRCode;

use App\Http\Controllers\Controller;
use PragmaRX\Google2FA\Google2FA;
use PragmaRX\Google2FA\Support\Constants;
use SimpleSoftwareIO\QrCode\Facades\QrCode as QR;

class GenerateQRCode extends Controller
{
	// https://www.simplesoftware.io/#/docs/simple-qrcode

	protected const SIZE = 300;

	protected const MARGIN = 5;

	protected const STYLE_SIZE = 0.5;

	//formats ['svg','png','eps']
	protected const FORMAT = 'svg';

	//background colors
	protected const BG_RED = 255;

	protected const BG_GREEN = 255;

	protected const BG_BLUE = 255;

	// transparency 0 = 0%, 25 = 25% , ... ,100 = 100%
	protected const BG_ALPHA = 90;

	//inner RGB eye colors
	protected const INNER_EYE_REG = 126;

	protected const INNER_EYE_GREEN = 127;

	protected const INNER_EYE_BLUE = 154;

	//outer RGB eye colors
	protected const OUTER_EYE_REG = 235;

	protected const OUTER_EYE_GREEN = 148;

	protected const OUTER_EYE_BLUE = 134;

	//gradient types ['vertical','horizontal','diagonal','inverse_diagonal','radial']
	protected const GRADIENT_TYPE = 'vertical';

	//inner gradient RGB colors
	protected const INNER_GRADIENT_REG = 0;

	protected const INNER_GRADIENT_GREEN = 0;

	protected const INNER_GRADIENT_BLUE = 0;

	//outer gradient RGB colors
	protected const OUTER_GRADIENT_REG = 0;

	protected const OUTER_GRADIENT_GREEN = 0;

	protected const OUTER_GRADIENT_BLUE = 0;

	//styles ['square','dot','round']
	protected const STYLE = 'square';

	//eye styles ['square', 'circle']
	protected const EYE_STYLE = 'circle';

	//eyes topLeft = 0, top right = 1 , bottom left = 2
	protected const EYE_POSITION = 0;

	//error correction ['H','Q','M','L']
	protected const ERROR_CORRECTION = 'H';

	private string $email;
	private $secretKey;

	public function __construct(
		private Google2FA $google2fa,
	) {
		// https://github.com/antonioribeiro/google2fa#use-a-bigger-key
		// algorithm can be changed to SHA1, SHA256 and SHA512.
		// it defaults to SHA1 if function is not called
		$this->google2fa->setAlgorithm(Constants::SHA1);
		$this->secretKey = $this->generateSecretKey();
	}

	public function setEmail(string $email)
	{
		$this->email = $email;
	}

	public function getSecretKey()
	{
		return $this->secretKey;
	}
	public function generateSecretKey()
	{
		return $this->google2fa->generateSecretKey();
	}

	public function getQrCodeUrl()
	{
		return $this->google2fa->getQRCodeUrl(
			config('app.name'),
			$this->email,
			$this->secretKey
		);
	}

	public function getQrCode($key)
	{
		return Qr::size(self::SIZE)
			->margin(self::MARGIN)
			->format(self::FORMAT)
			// ->merge(asset('assets/master/placeholders/poggy.png'), .3, true) #need IMAGIK php extension to work , also set format to png
			->eyeColor(
				self::EYE_POSITION,
				self::INNER_EYE_REG,
				self::INNER_EYE_GREEN,
				self::INNER_EYE_BLUE,
				self::OUTER_EYE_REG,
				self::OUTER_EYE_GREEN,
				self::OUTER_EYE_BLUE
			)
			->style(
				self::STYLE,
				self::STYLE_SIZE
			)
			->backgroundColor(
				self::BG_RED,
				self::BG_GREEN,
				self::BG_BLUE,
				self::BG_ALPHA
			)
			->gradient(
				self::INNER_GRADIENT_REG,
				self::INNER_GRADIENT_GREEN,
				self::INNER_GRADIENT_BLUE,
				self::OUTER_GRADIENT_REG,
				self::OUTER_GRADIENT_GREEN,
				self::OUTER_GRADIENT_BLUE,
				self::GRADIENT_TYPE
			)
			->eye(self::EYE_STYLE)
			->errorCorrection(self::ERROR_CORRECTION)
			->generate($key);
		//return $this->qrCodeUrl;
	}
}
