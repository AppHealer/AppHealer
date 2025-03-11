<?php
declare(strict_types=1);

namespace AppHealer\Jobs\Checks;

use AppHealer\Enums\AutomaticallyCreatedIncidentType;
use AppHealer\Enums\IncidentState;
use AppHealer\Models\Incident;
use AppHealer\Models\IncidentComment;
use AppHealer\Models\IncidentHistory;
use AppHealer\Models\Monitor;
use AppHealer\Models\MonitorCheck;
use AppHealer\Services\IncidentNotifier;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class WebsiteCheck implements ShouldQueue
{
	use Queueable;
	public int $timeout = 600;

	public function __construct(
		private Monitor $monitor
	)
	{
	}

	public function handle(): void
	{
		$start = now();
		try {
			$result = $this->getClient()->get($this->monitor->endpoint);
		} catch (ConnectionException $e) {
		}
		$check = MonitorCheck::create([
			'failed' => !isset($result)
				|| $result->getStatusCode() != 200
				|| $start->diffInSeconds(
					now()
				) > $this->monitor->timeout,
			'monitor_id' => $this->monitor->id,
			'statuscode' => isset($result) ? $result->getStatusCode() : 0,
			'timeout' => $start->diffInMilliseconds(now())
		]);
		$this->closeIncidentIfRequired($check->monitor);
		$this->createIncidentIfRequired($check->monitor);
	}

	protected function getClient(): PendingRequest
	{
		$client = Http::timeout(
			$this->monitor->timeout
		);
		if (
			$this->monitor->httpBasicAuthUser !== null
			&& $this->monitor->httpBasicAuthPassword !== null
		) {
			$client->withBasicAuth(
				$this->monitor->httpBasicAuthUser,
				$this->monitor->httpBasicAuthPassword
			);
		}
		return $client;
	}

	protected function createIncidentIfRequired(Monitor $monitor): void
	{
		if (
			$monitor->incidentCreateAvg !== null
			&& !$monitor->getOpenedAutomaticallyCreatedIncident(
				AutomaticallyCreatedIncidentType::AVG
			)
		) {
			$this->createAvgIncidentIfRequired($monitor);
		}
	}

	protected function closeIncidentIfRequired(Monitor $monitor): void
	{
		if (
			$monitor->incidentCloseAvg !== null
			&& $monitor->getOpenedAutomaticallyCreatedIncident(
				AutomaticallyCreatedIncidentType::AVG
			)
		) {
			$this->closeAvgIncidentIfRequired($monitor);
		}
	}

	protected function createAvgIncidentIfRequired(Monitor $monitor): void
	{
		$checks = $monitor->lastChecks(10, false);
		$timeouts = array_column($checks->toArray(), 'timeout');
		$avg = (int)(array_sum($timeouts) / count($timeouts));
		if ($avg > $monitor->incidentCreateAvg) {
			$this->createIncident(
				$monitor,
				AutomaticallyCreatedIncidentType::AVG,
				__('Large average timeout'),
				sprintf(
					'Average timeout is %s ms. Limit is %s ms',
					$avg,
					$monitor->incidentCreateAvg
				)
			);
		}
	}

	protected function closeAvgIncidentIfRequired(Monitor $monitor): void
	{
		$checks = $monitor->lastChecks(10, false);
		$timeouts = array_column($checks->toArray(), 'timeout');
		$avg = (int)(array_sum($timeouts) / count($timeouts));
		if ($avg < $monitor->incidentCloseAvg) {
			$this->closeIncident(
				$monitor->getOpenedAutomaticallyCreatedIncident(
					AutomaticallyCreatedIncidentType::AVG
				),
				sprintf(
					'Average timeout is below %s ms. Current average timeout is %s ms',
					$monitor->incidentCloseAvg,
					$avg
				)
			);
		}
	}

	protected function createIncident(
		Monitor $monitor,
		AutomaticallyCreatedIncidentType $type,
		string $caption,
		string $message
	): void
	{
		$incident = new Incident([
			'automaticType' => $type,
			'caption' => $caption,
		]);
		$monitor->incidents()->save($incident);
		$comment = new IncidentComment([
			'comment' => $message,
		]);
		$incident->comments()->save($comment);
		$incident->refresh();
		app()->make(IncidentNotifier::class)->notifyFromAutomat($incident);
	}

	protected function closeIncident(
		Incident $incident,
		string $message
	): void
	{
		$comment = new IncidentComment([
			'comment' => $message,
		]);
		$incident->comments()->save($comment);
		$history = new IncidentHistory([
			'prev_state' => $incident->state,
			'state' => IncidentState::CLOSED,
		]);
		$incident->history()->save($history);
		$incident->state = IncidentState::CLOSED;
		$incident->save();
		app()->make(IncidentNotifier::class)->notifyFromAutomat($incident);
	}
}
