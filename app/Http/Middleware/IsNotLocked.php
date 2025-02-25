<?php
declare(strict_types=1);

namespace AppHealer\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsNotLocked
{

	public function handle(Request $request, Closure $next): Response
	{
		if (auth()->user()->blocked === true) {
			auth()->logout();
			request()->session()->invalidate();
			return redirect(route('login'))->withErrors([
				'email' => _('User is locked'),
			]);
		}
		return $next($request);
	}
}
