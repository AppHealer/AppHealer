<?php

declare(strict_types=1);

namespace AppHealer\Http\Controllers\Dashboard;

use Illuminate\Http\Response;

class LastLoginsController
{

	public function index(): Response
	{
		/**
		 * @var \AppHealer\Models\User $user
		 */
		$user = auth()->user();
		return response()->view(
			'dashboard.lastLogins',
			[
				'logins' => auth()->user()
					->loginAuditlog->take(5)
			]
		);
	}
}
