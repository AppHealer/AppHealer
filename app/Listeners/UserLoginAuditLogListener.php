<?php

declare(strict_types=1);

namespace AppHealer\Listeners;

use DeviceDetector\DeviceDetector;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;

class UserLoginAuditLogListener
{
	public function handleUserLogin(Login $event): void
	{
		$this->storeEvent($event, false);
	}

	public function handleUserFailedLogin(Failed $event): void
	{
		if ($event->user !== null) {
			$this->storeEvent($event, true);
		}
	}

	/**
	 * @return string[]
	 */
	public function subscribe(): array
	{
		return [
			Failed::class => 'handleUserFailedLogin',
			Login::class => 'handleUserLogin',
		];
	}

	protected function storeEvent(
		Login|Failed $event,
		bool $failed
	): void
	{
		/**
		 * @var \AppHealer\Models\User $user
		 */
		$user = $event->user;
		list ($system, $browser) = $this->getBrowser();
		$user->loginAuditlog()->create([
			'browser' => $browser,
			'failed' => $failed,
			'ip_address' => request()->getClientIp(),
			'system' => $system,
			'user_agent' => request()->userAgent(),
		]);
	}

	/**
	 * @return non-empty-array<int, string|array|null>
	 */
	protected function getBrowser(): array
	{
		$detector = new DeviceDetector(
			request()->server->get('HTTP_USER_AGENT'),
		);
		$detector->parse();
		return [
			$detector->getOs('name'),
			$detector->getClient('name')
		];
	}
}
