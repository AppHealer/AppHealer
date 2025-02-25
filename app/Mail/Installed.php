<?php

declare(strict_types=1);

namespace AppHealer\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Installed extends Mailable
{
	use Queueable, SerializesModels;

	/**
	 * Create a new message instance.
	 */
	public function __construct()
	{
	}

	public function envelope(): Envelope
	{
		return new Envelope(
			subject: 'AppHealer Successfully Installed',
		);
	}

	public function content(): Content
	{
		return new Content(
			view: 'emails.installed'
		);
	}
}
