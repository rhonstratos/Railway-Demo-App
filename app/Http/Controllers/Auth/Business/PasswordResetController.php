<?php

namespace App\Http\Controllers\Auth\Business;

use App\Http\Controllers\Auth\PasswordResetLinkController as BasePasswordController;

class PasswordResetController extends BasePasswordController
{
    public function create()
    {
        return view('auth.business.forgot-password');
    }
}
