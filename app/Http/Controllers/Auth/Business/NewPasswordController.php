<?php

namespace App\Http\Controllers\Auth\Business;

use App\Http\Controllers\Auth\NewPasswordController as BaseNewPasswordController;
use Illuminate\Http\Request;

class NewPasswordController extends BaseNewPasswordController
{
    public function create(Request $request)
    {
        return view('auth.business.reset-password', ['request' => $request]);
    }
}
