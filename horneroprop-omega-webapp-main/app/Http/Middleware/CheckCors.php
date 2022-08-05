<?php

namespace App\Http\Middleware;

use Closure;

class CheckCors
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		$origin = '*';

		// if($request->segment(1) == 'ajax') {
		// 	$origin = 'http://localhost:4200';
		// }

		return $next($request)
			->header('Access-Control-Allow-Origin', $origin)
			->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
			->header('Access-Control-Allow-Headers', 'Authorization, Student, X-XSRF-TOKEN, X-Requested-With, X-Requested-For, Origin, Content-Type, Cache-Control');
	}
}
