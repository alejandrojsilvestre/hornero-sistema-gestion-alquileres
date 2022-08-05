<?php

namespace App\Http\Middleware;

use Closure;

class JsonPayload {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		if($jsonPayload = json_decode($request->post('_jsonPayload'), true)) {
			$request->request->remove('_jsonPayload');
			$request->request->add($jsonPayload);
		}

		return $next($request);
	}
}
