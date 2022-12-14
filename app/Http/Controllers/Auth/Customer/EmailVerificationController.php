<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Http\Controllers\Auth\EmailVerificationPromptController as BaseEmailVerification;
use Illuminate\Http\Request;

class EmailVerificationController extends BaseEmailVerification
{
    public function __invoke(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect()->route('customer.home.index') //->intended(RouteServiceProvider::HOME)
            : view('auth.customer.verify-email');
    }
}
