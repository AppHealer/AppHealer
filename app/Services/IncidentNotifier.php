<?php
declare(strict_types=1);

namespace AppHealer\Services;

use AppHealer\Enums\IncidentState;
use AppHealer\Mail\Incidents\IncidentClosed;
use AppHealer\Mail\Incidents\NewIncident;
use AppHealer\Models\Incident;
use Illuminate\Support\Facades\Mail;

class IncidentNotifier
{

	public function notifyFromAutomat(Incident $incident): void
	{
		if ($incident->state == IncidentState::NEW) {
			$notification = new NewIncident($incident);
		}
		if ($incident->state == IncidentState::CLOSED) {
			$notification = new IncidentClosed($incident);
		}
		if (
			isset($notification)
			&& $incident->monitor->notificationEmail !== null
		) {
			Mail::to(
				$incident->monitor->notificationEmail
			)->queue($notification);
		}
	}
}
