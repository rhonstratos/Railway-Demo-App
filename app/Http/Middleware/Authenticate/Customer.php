<?php

namespace App\Http\Middleware\Authenticate;

use App\Http\Middleware as BaseMiddelware;

class Customer extends BaseMiddelware\Authenticate
{
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('auth.customer.login');
        }
    }
}
