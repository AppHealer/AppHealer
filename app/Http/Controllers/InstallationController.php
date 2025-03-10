<?php
declare(strict_types=1);

namespace AppHealer\Http\Controllers;

use AppHealer\Http\Requests\Installation\CreateUser;
use AppHealer\Http\Requests\Installation\SaveEnvRequest;
use AppHealer\Models\User;
use AppHealer\Notifications\Installed;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class InstallationController
{

	public function index(): Response|RedirectResponse
	{
		if (!env('MAIL_HOST')) {
			$template = 'installation.env';
		} elseif (User::count() == 0) {
			$template = 'installation.user';
		} else {
			return redirect('/');
		}
		return response()->view(
			$template,
			[
				'appurl' => request()->getSchemeAndHttpHost(),
				'timezone' => trim((string)file_get_contents('/etc/timezone')),
			]
		);
	}

	public function saveEnv(
		SaveEnvRequest $request,
	): RedirectResponse
	{
		file_put_contents(
			base_path() . '/.env',
			file_get_contents(base_path() . '/.env') .
			sprintf(
				"APP_URL=%s\n" .
				"APP_TIMEZONE=%s\n" .
				"MAIL_HOST=%s\n" .
				"MAIL_PORT=%s\n" .
				"MAIL_USERNAME=%s\n" .
				"MAIL_PASSWORD=%s\n" .
				"MAIL_FROM_ADDRESS=%s\n",
				$request->input('appurl'),
				$request->input('timezone'),
				$request->input('smtpHost'),
				$request->input('smtpPort'),
				$request->input('smtpUser'),
				$request->input('smtpPassword'),
				$request->input('smtpUser'),
			)
		);
		return response()->redirectToRoute('installation');
	}

	public function createUser(
		CreateUser $request
	): RedirectResponse
	{
		Cache::flush();
		$user = new User([
			'email' => $request->input('email'),
			'name' => $request->input('name'),
			'password' => bcrypt($request->input('password')),
		]);
		$user->save();
		$user->refresh();
		User::first()->notify(new Installed());

		return response()->redirectToRoute('login');
	}
}
