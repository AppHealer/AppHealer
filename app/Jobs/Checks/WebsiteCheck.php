<?php
declare(strict_types=1);

namespace AppHealer\Jobs\Checks;

use AppHealer\Models\Monitor;
use AppHealer\Models\MonitorCheck;
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
}
