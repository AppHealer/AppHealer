<?php
declare(strict_types=1);

namespace AppHealer\Mail\Incidents;

use AppHealer\Models\Incident;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\Mime\Email;

class NewIncident extends Mailable
{
	use Queueable, SerializesModels;

	/**
	 * Create a new message instance.
	 */
	public function __construct(
		protected readonly Incident $incident,
	)
	{
	}

	public function envelope(): Envelope
	{
		$subject = sprintf(
			__('%s: New incident [#%s]'),
			$this->incident->monitor->name,
			$this->incident->id
		);
		return new Envelope(
			subject: $subject,
			using: function (Email $email): void {
				$email->priority(Email::PRIORITY_HIGHEST);
			}
		);
	}

	public function content(): Content
	{
		return new Content(
			view: 'emails.incidents.created',
			with: ['incident' => $this->incident],
		);
	}
}
