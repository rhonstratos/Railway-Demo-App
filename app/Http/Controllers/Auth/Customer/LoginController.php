<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Http\Controllers\Auth\AuthenticatedSessionController as BaseLoginController;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseLoginController
{
    public function create()
    {
        return view('auth.customer.login');
    }

    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        // enable admin to login in customer domain
        // uncomment to disable
        // if (Auth::user()->is_business) {
        //     $this->destroy($request);
        //     return
        //         redirect()->route('auth.customer.login')
        //         ->withErrors([
        //             'errors' => [
        //                 'The account you tried to login is a business account.',
        //                 // can throw more error string messages
        //             ],
        //         ]);
        // }

        return redirect()->route('customer.home.index');
    }
}
