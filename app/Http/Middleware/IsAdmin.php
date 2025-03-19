<?php
declare(strict_types=1);

namespace AppHealer\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{

	public function handle(Request $request, Closure $next): Response
	{
		if (auth()->user()->admin === false) {
			return redirect(route('forbidden.need-admin'));
		}
		return $next($request);
	}
}
