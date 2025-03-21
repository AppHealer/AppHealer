<?php
declare(strict_types=1);

namespace AppHealer\Notifications\Users;

use AppHealer\Mail\Users\PasswordReset as PasswordResetMail;
use AppHealer\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Notification;

class PasswordReset extends Notification implements ShouldQueue
{
	use Queueable;

	public function __construct(
		private string $token
	)
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
		return (new PasswordResetMail($this->token))
			->to($user->email);
	}
}
