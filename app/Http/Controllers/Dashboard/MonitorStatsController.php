<?php
declare(strict_types=1);

namespace AppHealer\Http\Controllers\Dashboard;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class MonitorStatsController
{

	public function slow(int $hours): Response
	{
		$monitors = $this->buildSlowestQuery($hours)
			->take(5)
			->get();
		return response()->view(
			'dashboard.monitors.slow',
			[
				'monitors' => $monitors,
			]
		);
	}

	public function failed(int $hours): Response
	{
		$monitors = $this->buildFailedQuery($hours)
			->take(5)
			->get();
		return response()->view(
			'dashboard.monitors.failed',
			[
				'monitors' => $monitors,
			]
		);
	}

	protected function buildFailedQuery(int $hours): Builder|HasManyThrough
	{
		return auth()->user()->monitors()
			->whereHas('checks')
			->withCount(
				[
					'checks as checks_ok' => function($query) use ($hours): void {
						$query->where('eventtime', '>', now()->subHours($hours));
						$query->where('failed', false);
					},
					'checks as checks_total' => function($query) use ($hours): void {
						$query->where('eventtime', '>', now()->subHours($hours));
					},
				]
			)
			->orderBy(
				DB::raw('checks_ok/checks_total'),
				'asc'
			);
	}

	protected function buildSlowestQuery(int $hours): Builder
	{
		return auth()->user()->monitors()
			->whereHas('checks')
			->withCount(
				[
					'checks as timeout_avg' => function($query) use ($hours): void {
						$query->where('eventtime', '>', now()->subHours($hours));
						$query->select(DB::raw('FLOOR(AVG(timeout))'));
					},
					'checks as timeout_max' => function($query) use ($hours): void {
						$query->where('eventtime', '>', now()->subHours($hours));
						$query->select(DB::raw('max(timeout)'));
					},
					'checks as timeout_min' => function($query) use ($hours): void {
						$query->where('eventtime', '>', now()->subHours($hours));
						$query->select(DB::raw('min(timeout)'));
					},
				]
			)
			->orderBy('timeout_avg', 'desc');
	}
}
