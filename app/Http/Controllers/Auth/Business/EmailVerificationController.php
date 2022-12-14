<?php

namespace App\Http\Controllers\Auth\Business;

use App\Http\Controllers\Auth\EmailVerificationPromptController as BaseEmailVerification;
use Illuminate\Http\Request;

class EmailVerificationController extends BaseEmailVerification
{
	public function __invoke(Request $request)
	{
		// redirect to mainpage
		return $request->user()->hasVerifiedEmail()
			? redirect()->route('business.dashboard.index') //->intended(RouteServiceProvider::HOME)
		 	: view('auth.business.verify-email');
	}
}
