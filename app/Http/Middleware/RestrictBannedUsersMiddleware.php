<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestrictBannedUsersMiddleware
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
		$user = Auth::user();
		if (Auth::check() && $user->is_banned) {
			return redirect()->route('restrict.banned.users');
		}
		return $next($request);
	}
}
