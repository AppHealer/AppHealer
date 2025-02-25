<?php

declare(strict_types=1);

namespace AppHealer\Http\Controllers\Monitors;

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
		Monitor $monitor
	): RedirectResponse
	{
		$monitor->fill(request()->all());
		if ($monitor->id === null) {
			$message =  'Monitor <i>:name</i> has been created.';
			$redirectTo = route('monitors');
		} else {
			$message =  'Monitor <i>:name</i> has been updated.';
			$redirectTo = route('monitors.detail', ['monitor' => $monitor]);
		}

		$monitor->save();
		return response()
			->redirectTo($redirectTo)
			->with(
				'message',
				__($message, ['name' => $monitor->name])
			);

	}
}
