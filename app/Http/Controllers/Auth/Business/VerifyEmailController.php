<?php

namespace App\Http\Controllers\Auth\Business;

use App\Http\Controllers\Auth\VerifyEmailController as BaseVerification;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends BaseVerification
{
	public function __invoke(EmailVerificationRequest $request)
	{
		// redirect to mainpage
		if ($request->user()->hasVerifiedEmail()) {
			return redirect()->route('business.dashboard.index', ['verified' => 1]); // ->intended(RouteServiceProvider::HOME.'?verified=1');
		}

		if ($request->user()->markEmailAsVerified()) {
			event(new Verified($request->user()));
		}

		return redirect()->route('business.dashboard.index', ['verified' => 1]); // ->intended(RouteServiceProvider::HOME.'?verified=1');
	}
}
