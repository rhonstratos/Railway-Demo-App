<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $this->verifiedRedirect($request);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return $this->verifiedRedirect($request);
    }

    public function verifiedRedirect(EmailVerificationRequest $request)
    {
		// redirect to mainpage
        if ($request->user()->is_business) {
            //dd('hit');
            return redirect()->route('business.dashboard.index');
        }

        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    }
}
