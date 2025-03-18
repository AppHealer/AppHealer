<?php
declare(strict_types=1);

namespace AppHealer\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsNotMe
{

	public function handle(Request $request, Closure $next): Response
	{

		if (auth()->user()->id === request('user')->id) {
			return back()->with([
				'error' => 'Cannot do this action on yourself.'
			]);

		}
		return $next($request);
	}
}
