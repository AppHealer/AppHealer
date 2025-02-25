<?php
declare(strict_types=1);

namespace AppHealer\Enums;

use Carbon\Carbon;

enum MonitorDetailTimeStep
{
	case EVERY_MINUTES_5;
	case EVERY_MINUTES_10;
	case EVERY_MINUTES_15;
	case EVERY_MINUTES_30;
	case EVERY_HOUR;
	case EVERY_HOURS_2;
	case EVERY_HOURS_4;
	case EVERY_HOURS_6;
	case EVERY_DAY;

	public static function fromDates(
		Carbon $dateFrom,
		Carbon $dateTo
	): self
	{
		$diff = $dateFrom->diffInMinutes($dateTo);
		$steps = [
			1 * 60 * 1      => MonitorDetailTimeStep::EVERY_MINUTES_5,
			1 * 60 * 2      => MonitorDetailTimeStep::EVERY_MINUTES_10,
			1 * 60 * 3      => MonitorDetailTimeStep::EVERY_MINUTES_15,
			1 * 60 * 7      => MonitorDetailTimeStep::EVERY_MINUTES_30,
			1 * 60 * 10     => MonitorDetailTimeStep::EVERY_HOUR,
			2 * 60 * 12     => MonitorDetailTimeStep::EVERY_HOURS_2,
			2 * 60 * 24     => MonitorDetailTimeStep::EVERY_HOURS_4,
			4 * 60 * 24     => MonitorDetailTimeStep::EVERY_HOURS_6,
		];
		foreach ($steps as $minutes => $step) {
			if ($diff < $minutes) {
				return $step;
			}
		}
		return self::EVERY_DAY;
	}

	public function getCarbonModifyString(): string
	{
		return match ($this) {
			self::EVERY_MINUTES_5 => '+5 minutes',
			self::EVERY_MINUTES_10 => '+10 minutes',
			self::EVERY_MINUTES_15 => '+15 minutes',
			self::EVERY_MINUTES_30 => '+30 minutes',
			self::EVERY_HOUR => '+1 hour',
			self::EVERY_HOURS_2 => '+2 hours',
			self::EVERY_HOURS_4 => '+4 hours',
			self::EVERY_HOURS_6 => '+6 hours',
			self::EVERY_DAY => '+1 day',
		};
	}

	public function adjustDate(Carbon $date): void
	{
		if ($this->getAdjustDateModifyString($date)) {
			$date->modify($this->getAdjustDateModifyString($date));
		}
		if ($this->adjustStartOfHour()) {
			$date->startOfHour();
		}
		if ($this == self::EVERY_DAY) {
			$date->startOfDay();
		}
	}

	protected function adjustStartOfHour(): bool
	{
		return match ($this) {
			self::EVERY_HOUR => true,
			self::EVERY_HOURS_2 => true,
			self::EVERY_HOURS_4 => true,
			self::EVERY_HOURS_6 => true,
			default => false,
		};
	}

	protected function getAdjustDateModifyString(Carbon $date): ?string
	{
		return match ($this) {
			self::EVERY_MINUTES_5 =>  '-' . $date->minute % 5 . ' minutes',
			self::EVERY_MINUTES_10 => '-' . $date->minute % 10 . ' minutes',
			self::EVERY_MINUTES_15 => '-' . $date->minute % 15 . ' minutes',
			self::EVERY_MINUTES_30 => '-' . $date->minute % 30 . ' minutes',
			self::EVERY_HOURS_2 => '-' . $date->hour % 2 . ' hours',
			self::EVERY_HOURS_4 =>'-' . $date->hour % 4 . ' hours',
			self::EVERY_HOURS_6 => '-' . $date->hour % 6 . ' hours',
			default => null,
		};
	}

	public function getGroupByString(): string
	{
		return match ($this) {
			//phpcs:disable
			self::EVERY_MINUTES_5 => 'concat(year(eventtime), "-", lpad(month(eventtime), 2, "0"), "-", lpad(day(eventtime), 2, "0"), " ", lpad(hour(eventtime), 2, "0"), ":",  lpad(floor(minute(eventtime) / 5) * 5, 2, "0"))',
			self::EVERY_MINUTES_10 => 'concat(year(eventtime), "-", lpad(month(eventtime), 2, "0"), "-", lpad(day(eventtime), 2, "0"), " ", lpad(hour(eventtime), 2, "0"), ":",  lpad(floor(minute(eventtime) / 10) * 10, 2, "0"))',
			self::EVERY_MINUTES_15 =>'concat(year(eventtime), "-", lpad(month(eventtime), 2, "0"), "-", lpad(day(eventtime), 2, "0"), " ", lpad(hour(eventtime), 2, "0"), ":",  lpad(floor(minute(eventtime) / 15) * 15, 2, "0"))',
			self::EVERY_MINUTES_30 =>'concat(year(eventtime), "-", lpad(month(eventtime), 2, "0"), "-", lpad(day(eventtime), 2, "0"), " ", lpad(hour(eventtime), 2, "0"), ":",  lpad(floor(minute(eventtime) / 30) * 30, 2, "0"))',
			self::EVERY_HOUR => 'concat(year(eventtime), "-", lpad(month(eventtime), 2, "0"), "-", lpad(day(eventtime), 2, "0"), " ", lpad(hour(eventtime), 2, "0"), ":00")',
			self::EVERY_HOURS_2 =>'concat(year(eventtime), "-", lpad(month(eventtime), 2, "0"), "-", lpad(day(eventtime), 2, "0"), " ", lpad(floor(hour(eventtime) / 2) * 2, 2, "0"), ":00") ',
			self::EVERY_HOURS_4 =>'concat(year(eventtime), "-", lpad(month(eventtime), 2, "0"), "-", lpad(day(eventtime), 2, "0"), " ", lpad(floor(hour(eventtime) / 4) * 4, 2, "0"), ":00") ',
			self::EVERY_HOURS_6 =>'concat(year(eventtime), "-", lpad(month(eventtime), 2, "0"), "-", lpad(day(eventtime), 2, "0"), " ", lpad(floor(hour(eventtime) / 6) * 6, 2, "0"), ":00") ',
			self::EVERY_DAY => 'concat(year(eventtime), "-", lpad(month(eventtime), 2, "0"), "-", lpad(day(eventtime), 2, "0"),  " 00:00")',
			//phpcs:enable
		};
	}

	public function getLabelFormat(): string
	{
		return match ($this) {
			self::EVERY_MINUTES_5 => 'H:i',
			self::EVERY_MINUTES_10 => 'H:i',
			self::EVERY_MINUTES_15 => 'H:i',
			self::EVERY_MINUTES_30 => 'H:i',
			self::EVERY_HOUR => 'H:i',
			self::EVERY_HOURS_2 => 'H:i',
			self::EVERY_HOURS_4 => 'd/m H:i',
			self::EVERY_HOURS_6 => 'd/m H:i',
			self::EVERY_DAY => 'd/m'
		};
	}
}
