<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Http\Controllers\Auth\NewPasswordController as BaseNewPasswordController;
use Illuminate\Http\Request;

class NewPasswordController extends BaseNewPasswordController
{
    public function create(Request $request)
    {
        return view('auth.customer.reset-password', ['request' => $request]);
    }
}
