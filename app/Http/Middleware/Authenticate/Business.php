<?php

namespace App\Http\Middleware\Authenticate;

use App\Http\Middleware as BaseMiddelware;

class Business extends BaseMiddelware\Authenticate
{
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('auth.business.login');
        }
    }
}
