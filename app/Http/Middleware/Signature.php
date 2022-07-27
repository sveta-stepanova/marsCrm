<?php

namespace App\Http\Middleware;

use App\Exceptions\AppException;
use Closure;

class Signature {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 * @return mixed
	 */

	public function handle($request, Closure $next, $salt) {
		if (config('app.env') == 'local') {
			return $next($request);
		}
//		$email = $request->uemail ?? $request->Email;
//		if (!$email) {
//			throw AppException::signatureCheckNoEmail();
//		}
//		$signature = $request->key ?? $request->Signature;
//		if (!$signature || $signature != md5($email . $salt)) {
//			throw AppException::signatureCheckInvalidSignature();
//		}
		return $next($request);
	}
}
