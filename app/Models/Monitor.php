<?php
declare(strict_types=1);

namespace AppHealer\Models;

use AppHealer\Casts\Password;
use AppHealer\Enums\AutomaticallyCreatedIncidentType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Monitor extends Model
{
	protected $table = 'monitors';

	public $timestamps = true;
	protected $fillable = [
		'endpoint',
		'name',
		'httpBasicAuthUser',
		'httpBasicAuthPassword',
		'incidentCreateAvg',
		'incidentCreateCount',
		'incidentCloseAvg',
		'incidentCloseCount',
		'interval',
		'notificationEmail',
		'timeout',
	];

	protected $casts = [
		'httpBasicAuthPassword' => Password::class
	];

	public function checks(): HasMany
	{
		return $this->hasMany(MonitorCheck::class)
			->orderBy('eventtime', 'desc');
	}

	public function lastChecks(
		int $limit,
		bool $fromOldest = true
	): Collection
	{
		$checks = $this->hasMany(MonitorCheck::class)
			->orderBy('eventtime', 'desc')
			->limit($limit)->get();
		if ($fromOldest) {
			return $checks->sortBy('eventtime');
		}
		return $checks;

	}

	public function lastcheck(): HasOne
	{
		return $this->hasOne(MonitorCheck::class)
			->orderBy('eventtime', 'desc')
			->limit(1);
	}

	public function getUpAttribute(): Carbon
	{
		$lastFailure = $this->checks()
			->where('failed', true)
			->orderBy('eventtime', 'desc')
			->first()?->eventtime;
		$firstUp = $this->checks()
			->where('failed', false)
			->min('eventtime');

		return $lastFailure ?? Carbon::create($firstUp);
	}

	public function getDownAttribute(): Carbon
	{
		$lastFailure = $this->checks()
			->where('failed', false)
			->max('eventtime');
		if ($lastFailure !== null) {
			return Carbon::create($lastFailure);
		} else {
			return $this->created_at; // phpcs:ignore Squiz.NamingConventions.ValidVariableName
		}
	}

	public function getStatusAttribute(): bool
	{
		return $this->lastcheck->failed ?? false;
	}

	public function getLastCheckTimeoutAttribute(): ?int
	{
		return $this->lastcheck->timeout ?? null;
	}

	public function incidents(): HasMany
	{
		return $this->hasMany(Incident::class);
	}

	/**
	 * @return string[]
	 */
	public function casts(): array
	{
		return [
			'down' => 'datetime',
			'up' => 'datetime',
		];
	}

	public function getOpenedAutomaticallyCreatedIncident(
		AutomaticallyCreatedIncidentType $type,
	): ?Incident
	{
		return $this->incidents()
			->notClosed()
			->where('automaticType', $type)
			->first();
	}
}
