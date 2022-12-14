<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Http\Controllers\Auth\EmailVerificationNotificationController as BaseController;
use Illuminate\Http\Request;

class NotifyEmailVerification extends BaseController
{
	/**
	 * Send a new email verification notification.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(Request $request)
	{
		// redirect to mainpage
		if ($request->user()->hasVerifiedEmail()) {
			// return dump($this::class);
			return redirect()->route('customer.home.index');
		}

		$request->user()->sendEmailVerificationNotification();

		return back()->with('status', 'verification-link-sent');
	}
}
