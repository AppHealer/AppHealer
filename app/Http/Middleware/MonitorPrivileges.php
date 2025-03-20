<?php
declare(strict_types=1);

namespace AppHealer\Http\Middleware;

use AppHealer\Models\Monitor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MonitorPrivileges
{

	public function handle(
		Request $request,
		Closure $next,
		string $privilege
	): Response
	{
		if (
			auth()->user()->admin === true
			||	$this->can(
				request('monitor'),
				$privilege
			)
		) {
			return $next($request);
		}

		if (request('monitor') !== null) {
			return response()->redirectToRoute(
				'monitors.needs-privileges',
				[
					'monitor' => request('monitor'),
				]
			);
		} else {
			return response()->redirectToRoute(
				'monitors',
			)->with([
				'error' => __('You need privilege to create monitors')
			]);
		}
	}

	public function can(
		Monitor $monitor,
		string $privilege,
	): bool
	{
		return match ($privilege) {
			'create' => auth()->user()->hasGlobalPrivilege('monitors', 'create'),
			'edit' => (
				auth()->user()->hasGlobalPrivilege('monitors', 'edit-all')
				|| auth()->user()->getRoleInMonitor($monitor)->canEdit()
			),
			'delete' => (
				auth()->user()->hasGlobalPrivilege('monitors', 'delete-all')
				|| auth()->user()->getRoleInMonitor($monitor)->canDelete()
			),
			'team' => (
				auth()->user()->hasGlobalPrivilege('monitors', 'team-all')
				|| auth()->user()->getRoleInMonitor($monitor)->canManageTeam()
				),
			'run' => (
				auth()->user()->hasGlobalPrivilege('monitors', 'run-all')
				|| auth()->user()->getRoleInMonitor($monitor)->canRun()
			),
			default => false
		};
	}
}
