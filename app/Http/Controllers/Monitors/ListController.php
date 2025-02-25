<?php
declare(strict_types=1);

namespace AppHealer\Http\Controllers\Monitors;

use AppHealer\Models\Monitor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ListController
{
	public function index(): Response
	{
		$monitors = $this->getMonitors(
			request('search'),
			request('sort') ?? 'down',
		);
		return response()->view(
			'monitors.list',
			['monitors' => $monitors]
		);
	}

	public function list(
		Request $request,
	): Response
	{
		$monitors = $this->getMonitors(
			$request->get('search'),
			$request->get('sort') ?? 'down',
		);
		return response()->view(
			'monitors.components.list',
			['monitors' => $monitors]
		);
	}

	protected function getMonitors(
		?string $search,
		?string $sort = null
	): Collection
	{

		$query = $this->getBasicQuery();
		if ($search !== null) {
			$query->where(
				function ($query) use ($search): void {
					$query->where(
						'name',
						'like',
						'%' . $search . '%'
					);
					$query->orWhere(
						'endpoint',
						'like',
						'%' . $search . '%'
					);
				}
			);
		}
		return $this->sortMonitors($query->get(), $sort);
	}

	protected function getBasicQuery(): Builder
	{
		return Monitor::query()
			->leftJoin(
			DB::raw('
				(SELECT
					count(id) as checks_all,
					count(id) - sum(failed) as checks_ok,
					monitor_id
				FROM 
					monitor_checks
				WHERE eventtime > "' . now()->subHours(24) . '"
				GROUP BY monitor_id
				) AS checks		
			'),
			'checks.monitor_id',
			'=',
			'monitors.id'
		);
	}

	protected function sortMonitors(
		Collection $monitors,
		string $sortBy = 'down'
	): Collection
	{
		$sort = [
			'alphabetical' => [
				['name', 'asc']
			],
			'down' => [
				['status', 'desc'],
				['name', 'asc'],
			],
			'up' => [
				['status', 'asc'],
				['name', 'asc'],
			],
		];
		if (array_key_exists($sortBy, $sort)) {
			return $monitors->sortBy($sort[$sortBy]);
		}

		return $monitors;
	}
}
