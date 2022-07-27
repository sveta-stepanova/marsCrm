<?php

namespace App\Http\Middleware;

use App\Models\AspNetUser;
use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @param string $requiredRole
	 * @param string $redirectUnauthorized
	 * @return mixed
	 * @throws \Exception
	 */
    public function handle($request, Closure $next, string $requiredRole = 'breeder', string $redirectUnauthorized = 'login') {
    	if (!Auth::check()) {
                return redirect()->route($redirectUnauthorized);
        }
        /** @var AspNetUser $user */
    	$user = Auth::user();
    	switch ($requiredRole) {
			case 'breeder':
				if (!$user->breeders()->count()) {
					return redirect()->route($redirectUnauthorized);
				}
				break;
			case 'oper':
				if (!$user->staff()->count()) {
					return redirect()->route($redirectUnauthorized);
				}
				break;
			default:
				throw new \Exception('Unknown role');
		}
        return $next($request);
    }
}
