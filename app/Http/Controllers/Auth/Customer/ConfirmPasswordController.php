<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Http\Controllers\Auth\ConfirmablePasswordController as BaseConfirmPassword;

class ConfirmPasswordController extends BaseConfirmPassword
{
    /**
     * Show the confirm password view.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('auth.customer.confirm-password');
    }
}
