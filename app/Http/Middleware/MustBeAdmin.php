<?php

namespace App\Http\Middleware;

use App\Models\AspNetUser;
use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class MustBeAdmin {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		/** @var AspNetUser $user */
		$user = Auth::user();
		if (!$user) {
			return redirect()->route('admin-login');
		}
		if (!$user->staff()->count()) {
			return redirect('/');
		}
		return $next($request);
	}
}
