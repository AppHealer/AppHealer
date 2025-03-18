<?php
declare(strict_types=1);

namespace AppHealer\Http\Controllers\Monitors;

use AppHealer\Enums\MonitorUserRole;
use AppHealer\Http\Requests\AdduserToMonitorRequest;
use AppHealer\Models\Monitor;
use AppHealer\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class TeamController
{

	public function list(
		Monitor $monitor
	): Response
	{
		return response()
		->view(
			'monitors.team',
			[
				'monitor' => $monitor,
				'roles' => array_column(MonitorUserRole::cases(), 'value')
			]
		);
	}

	public function assignRole(
		Monitor $monitor,
		User $user,
		string $role
	): RedirectResponse
	{
		$monitor->team()->updateExistingPivot($user->id, ['role' => $role]);
		return response()
		->redirectToRoute(
			'monitors.team',
			['monitor' => $monitor]
		)
		->with([
			'message' => __(
				'Role of :name has been changed to :role',
				[
					'name' => $user->name,
					'role' => $role
				]
			),
		]);
	}

	public function removeFromTeam(
		Monitor $monitor,
		User $user
	): RedirectResponse
	{
		$monitor->team()->detach($user);
		return response()
		->redirectToRoute(
			'monitors.team',
			['monitor' => $monitor]
		)
		->with([
			'message' => __(
				':name has been removed from the team',
				[
					'name' => $user->name,
				]
			),
		]);
	}

	public function add(
		Monitor $monitor
	): Response
	{
		$users = User::query()
			->whereNotIn(
				'id',
				$monitor->team()->select('user_id')
			)
			->orderBy('name')
			->get();
		return response()
		->view(
			'monitors.team-add',
			[
				'monitor' => $monitor,
				'roles' => array_column(
					\AppHealer\Enums\MonitorUserRole::cases(),
					'value'
				),
				'users' => $users
			]
		);
	}

	public function addSubmit(
		Monitor $monitor,
		AdduserToMonitorRequest $request
	): RedirectResponse
	{
		$monitor->team()->attach(
			$request->post('user'),
			['role' => $request->post('role')]
		);
		return redirect()
			->route(
				'monitors.team',
				['monitor' => $monitor])
			->with([
				'message' => __(
					':name has been added to the team.',
					[
						'name' => User::find(
							$request->post('user')
						)->name
					]
				)
			]);
	}
}
