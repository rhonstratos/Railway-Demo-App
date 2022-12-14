<?php

namespace App\Http\Controllers\Auth\Business;

use App\Http\Controllers\Auth\AuthenticatedSessionController as BaseLoginController;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseLoginController
{
	public function create()
	{
		return view('auth.business.login');
	}

	public function store(LoginRequest $request)
	{
		$request->authenticate();

		$request->session()->regenerate();

		if (!Auth::user()->is_business) {
			$this->destroy($request);

			return
				redirect()->route('auth.business.login')
					->withErrors([
						'errors' => [
							'The account you tried to login is not a business account.',
							// can throw more error string messages

						],
					]);
		}
		// redirect to mainpage
		return redirect()->route('business.dashboard.index');
	}
}
