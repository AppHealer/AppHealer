<?php

declare(strict_types=1);

namespace AppHealer\Http\Controllers\Monitors;

use AppHealer\Enums\MonitorUserRole;
use AppHealer\Http\Requests\MonitorRequest;
use AppHealer\Models\Monitor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class EditController
{

	public function create(): Response
	{
		return response()->view('monitors.edit');
	}

	public function edit(
		Monitor $monitor
	): Response
	{
		return response()->view(
			'monitors.edit',
			['monitor' => $monitor]
		);
	}

	public function save(
		Monitor $monitor,
		MonitorRequest $request
	): RedirectResponse
	{
		$monitor->fill($request->all());
		$addTeamMember = false;
		if ($monitor->id === null) {
			$message =  'Monitor <i>:name</i> has been created.';
			$redirectTo = route('monitors');
			$addTeamMember = true;
		} else {
			$message =  'Monitor <i>:name</i> has been updated.';
			$redirectTo = route('monitors.detail', ['monitor' => $monitor]);
		}

		$monitor->save();
		if ($addTeamMember) {
			$monitor->team()->attach(
				auth()->user()->id,
				['role' => MonitorUserRole::MANAGER],
				true
			);
		}

		return response()
			->redirectTo($redirectTo)
			->with(
				'message',
				__($message, ['name' => $monitor->name])
			);
	}
}
