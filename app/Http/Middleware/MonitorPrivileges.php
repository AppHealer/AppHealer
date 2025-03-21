<?php
declare(strict_types=1);

namespace AppHealer\Http\Middleware;

use AppHealer\Enums\GlobalPrivilegesAction;
use AppHealer\Enums\GlobalPrivilegesGroup;
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
			//phpcs:disable
			'create' => auth()->user()->hasGlobalPrivilege(GlobalPrivilegesGroup::MONITORS, GlobalPrivilegesAction::CREATE),
			'view' => (
				auth()->user()->hasGlobalPrivilege(GlobalPrivilegesGroup::MONITORS, GlobalPrivilegesAction::VIEW_ALL) //phpcs:disable
				|| auth()->user()->getRoleInMonitor($monitor) !== null
			),
			'edit' => (
				auth()->user()->hasGlobalPrivilege(GlobalPrivilegesGroup::MONITORS, GlobalPrivilegesAction::EDIT_ALL)
				|| auth()->user()->getRoleInMonitor($monitor)->canEdit()
			),
			'delete' => (
				auth()->user()->hasGlobalPrivilege(GlobalPrivilegesGroup::MONITORS, GlobalPrivilegesAction::DELETE_ALL)
				|| auth()->user()->getRoleInMonitor($monitor)->canDelete()
			),
			'team' => (
				auth()->user()->hasGlobalPrivilege(GlobalPrivilegesGroup::MONITORS, GlobalPrivilegesAction::TEAM_ALL)
				|| auth()->user()->getRoleInMonitor($monitor)->canManageTeam()
				),
			'run' => (
				auth()->user()->hasGlobalPrivilege(GlobalPrivilegesGroup::MONITORS, GlobalPrivilegesAction::RUN_ALL)
				|| auth()->user()->getRoleInMonitor($monitor)->canRun()
			),
			default => false
			//phpcs:enable
		};
	}
}
