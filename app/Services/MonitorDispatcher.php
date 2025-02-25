<?php
declare(strict_types=1);

namespace AppHealer\Services;

use AppHealer\Jobs\Checks\WebsiteCheck;
use AppHealer\Models\Monitor;

class MonitorDispatcher
{
	public function dispatchMonitors(int $interval): void
	{
		$monitors = Monitor::query()
			->where('interval', $interval)
			->get();
		foreach ($monitors as $monitor) {
			WebsiteCheck::dispatch($monitor);
		}

	}
}
