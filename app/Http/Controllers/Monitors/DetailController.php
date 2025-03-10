<?php
declare(strict_types=1);

namespace AppHealer\Http\Controllers\Monitors;

use AppHealer\DTOs\CheckStateDTO;
use AppHealer\Enums\MonitorDetailTimeStep;
use AppHealer\Jobs\Checks\WebsiteCheck;
use AppHealer\Models\Monitor;
use AppHealer\Models\MonitorCheck;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class DetailController
{

	public function detail(
		Monitor $monitor
	): Response
	{
		list($dateFrom, $dateTo) = $this->getDates();
		list($dateFrom, $dateTo, $rangeErrorMsg) = $this->adjustDatesAndGetError(
			$dateFrom,
			$dateTo
		);

		return response()->view(
			'monitors.detail',
			[
				'data' => $this->getDataRange($monitor, $dateFrom, $dateTo),
				'dateFrom' => $dateFrom,
				'dateTo' => $dateTo,
				'monitor' => $monitor,
				'rangeErrorMsg' => $rangeErrorMsg,
				'summary' => $this->getDataSummary($monitor, $dateFrom, $dateTo),
			]
		);
	}

	public function schedule(
		Monitor $monitor
	): RedirectResponse
	{
		WebsiteCheck::dispatch($monitor);
		return response()
			->redirectToRoute(
				'monitors.detail',
				['monitor' => $monitor]
			)
			->with(
				'message',
				__('Check was scheduled for now!')
			);
	}

	/**
	 * @return mixed[]
	 */
	protected function adjustDatesAndGetError(
		Carbon $dateFrom,
		Carbon $dateTo
	): array
	{
		$date = clone $dateTo;
		$msg = null;
		if ($dateTo < $dateFrom) {
			$dateTo = Carbon::create($dateFrom);
			$dateFrom = Carbon::create($date);
		}
		if ($dateTo > now()) {
			$dateTo = now();
			$msg = __('End date of report cannot be in future. ');
		} elseif ($dateFrom->diffInDays($dateTo) > 14) {
			$date->modify('-14 days');
			$dateFrom->setDateFrom($date);
			$msg = __('Report can be displayed for maximally 14 days period. ');
		} elseif ($dateFrom->diffInMinutes($dateTo) < 30) {
			$dateFrom = Carbon::create($date)->modify('-30 minute');
			$msg = __('Report can be displayed for at least 30 minutes period. ');
		}

		return [$dateFrom, $dateTo, $msg];
	}

	/**
	 * @return Carbon[]
	 */
	protected function getDates(): array
	{
		if (request()->has('dateFrom')) {
			$dateFrom = Carbon::createFromTimeString(request('dateFrom'));
		} else {
			$dateFrom = now()->modify('-30 minute');
		}

		if (request()->has('dateTo')) {
			$dateTo = Carbon::createFromTimeString(request('dateTo'));
		} else {
			$dateTo = now();
		}
		$dateFrom->second(0);
		$dateTo->second(0);
		return [$dateFrom, $dateTo];
	}

	protected function getDataSummary(
		Monitor $monitor,
		Carbon $dateFrom,
		Carbon $dateTo
	): CheckStateDTO
	{
		$data = $this->getBasicQuery($monitor, $dateFrom, $dateTo)
		->first();
		return new CheckStateDTO(
			avg: (float)$data->timeoutAvg,
			min: (int)$data->timeoutMin,
			max: (int)$data->timeoutMax,
			total: (int)$data->checksCount,
			failed: (int)$data->failedCount,
		);
	}

	/**
	 * @return CheckStateDTO[]
	 */
	protected function getDataRange(
		Monitor $monitor,
		Carbon $dateFrom,
		Carbon $dateTo,
	): array
	{
		$step = MonitorDetailTimeStep::fromDates($dateFrom, $dateTo);
		$rslt = $this->buildEmptyData($dateFrom, $dateTo);

		$data = $this->getBasicQuery($monitor, $dateFrom, $dateTo)
			->selectRaw(
				$step->getGroupByString() . ' AS  timegroup'
			)
			->groupBy('timegroup')
			->get();
		foreach ($data as $item) {
			$rslt[$item->timegroup] = new CheckStateDTO(
				index: $rslt[$item->timegroup]->getIndex(),
				label: $rslt[$item->timegroup]->getLabel(),
				avg: (float)$item->timeoutAvg,
				max: (int)$item->timeoutMax,
				min: (int)$item->timeoutMin,
				total: (int)$item->checksCount,
				failed:  (int)$item->failedCount,
			);
		}
		return $rslt;
	}

	protected function getBasicQuery(
		Monitor $monitor,
		Carbon $dateFrom,
		Carbon $dateTo,
	): Builder
	{
		return MonitorCheck::query()
			->selectRaw('avg(timeout) as timeoutAvg')
			->selectRaw('max(timeout) as timeoutMax')
			->selectRaw('min(timeout) as timeoutMin')
			->selectRaw('count(1) as checksCount')
			->selectRaw('sum(failed) as failedCount')
			->where('eventtime', '>=', $dateFrom)
			->where('eventtime', '<=', $dateTo)
			->where('monitor_id', $monitor->id);
	}

	/**
	 * @return CheckStateDTO[]
	 */
	protected function buildEmptyData(
		Carbon $dateFrom,
		Carbon $dateTo
	): array
	{
		$rslt = [];
		$i = 0;
		$step = MonitorDetailTimeStep::fromDates($dateFrom, $dateTo);
		$step->adjustDate($dateFrom);
		$date = clone $dateFrom;
		while (true) {
			$rslt[$date->format(('Y-m-d H:i'))] = new CheckStateDTO(
				index: $i++,
				label: $date->format(
					$step->getLabelFormat()
				),
			);
			$date->modify($step->getCarbonModifyString());
			if ($date > $dateTo) {
				break;
			}
		}
		return $rslt;
	}
}
