<?php

use AppHealer\Http\Middleware\Installed;
use AppHealer\Http\Middleware\IsAdmin;
use AppHealer\Http\Middleware\IsNotLocked;
use AppHealer\Http\Middleware\IsNotMe;
use AppHealer\Http\Middleware\MonitorPrivileges;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
	->withRouting(
		web: __DIR__.'/../routes/web.php',
		commands: __DIR__.'/../routes/console.php',
		health: '/up',
	)
	->withMiddleware(function (Middleware $middleware) {
		$middleware->alias([
			'isNotLocked' => IsNotLocked::class,
			'installed' => Installed::class,
			'isNotMe' => IsNotMe::class,
			'isAdmin' => IsAdmin::class,
			'monitorPrivileges' => MonitorPrivileges::class,
		]);
	})
	->withProviders(require 'providers.php')
	->withExceptions(function (Exceptions $exceptions) {
	})->create();
