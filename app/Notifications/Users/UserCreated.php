<?php
declare(strict_types=1);

namespace AppHealer\Notifications\Users;

use AppHealer\Mail\Users\UserCreated as UserCreatedMail;
use AppHealer\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Notification;

class UserCreated extends Notification
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
		return (new UserCreatedMail($this->token))
			->to($user->email);
	}
}
