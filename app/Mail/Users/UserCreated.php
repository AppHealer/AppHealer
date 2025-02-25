<?php
declare(strict_types=1);

namespace AppHealer\Mail\Users;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserCreated extends Mailable
{
	use Queueable, SerializesModels;

	/**
	 * Create a new message instance.
	 */
	public function __construct(
		protected string $token
	)
	{
	}

	public function envelope(): Envelope
	{
		return new Envelope(
			subject: 'Your account has been created.',
		);
	}

	public function content(): Content
	{
		return new Content(
			view: 'emails.user.created',
			with: ['resettoken' => $this->token]
		);
	}
}
