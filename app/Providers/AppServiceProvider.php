<?php
declare(strict_types=1);

namespace AppHealer\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	public function boot(): void
	{
	}

	public function register(): void
	{
		Paginator::defaultView('_components.pagination');
		date_default_timezone_set(config('app.timezone', 'UTC'));
	}
}
