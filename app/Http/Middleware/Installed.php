<?php
declare(strict_types=1);

namespace AppHealer\Http\Middleware;

use AppHealer\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Installed
{

	public function handle(Request $request, Closure $next): Response
	{
		if (User::count() === 0) {
			return redirect(route('installation'));
		}
		return $next($request);
	}
}
