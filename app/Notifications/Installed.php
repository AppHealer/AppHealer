<?php
declare(strict_types=1);

namespace AppHealer\Notifications;

use AppHealer\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Notification;

class Installed extends Notification implements ShouldQueue
{
	use Queueable;

	public function __construct()
	{
	}

	/**
	 * @return string[]
	 */
	public function via(): array
	{
		return ['mail'];
	}

	public function toMail(User $user): Mailable
	{
		return (new \AppHealer\Mail\Installed())
			->to($user->email);
	}
}
