<?php
declare(strict_types=1);

namespace AppHealer\Jobs\Checks;

use AppHealer\Models\Monitor;
use AppHealer\Models\MonitorCheck;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Http\Client\ConnectionException;
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
			$client = Http::timeout(
				$this->monitor->timeout
			)->get($this->monitor->endpoint);
		} catch (ConnectionException $e) {
		}
		$check = MonitorCheck::create([
			'failed' => !isset($client)
				|| $client->getStatusCode() != 200
				|| $start->diffInSeconds(
					now()
				) > $this->monitor->timeout,
			'monitor_id' => $this->monitor->id,
			'statuscode' => isset($client) ? $client->getStatusCode() : 0,
			'timeout' => $start->diffInMilliseconds(now())
		]);
	}
}
