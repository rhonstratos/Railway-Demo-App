<?php

namespace App\Http\Middleware\Customer;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureAddressHasValueMiddleware
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
	 * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
	 */
	public function handle(Request $request, Closure $next)
	{
		if (!Auth::user()->address) {
			return redirect()->route('customer.settings.index')
				->withErrors([
					'To checkout, make sure you to save your address first.'
				]);
		}
		return $next($request);
	}
}
