<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Http\Controllers\Auth\PasswordResetLinkController as BasePasswordController;

class PasswordResetController extends BasePasswordController
{
    public function create()
    {
        return view('auth.customer.forgot-password');
    }
}
