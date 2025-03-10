<?php
declare(strict_types=1);

namespace AppHealer\Models;

use AppHealer\Enums\AutomaticallyCreatedIncidentType;
use AppHealer\Enums\IncidentState;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Incident extends Model
{
	protected $table = 'incidents';

	protected $fillable = [
		'assigned_user_id',
		'automaticType',
		'caption',
		'closed_by',
		'created_by',
		'datetime_closed',
		'monitor_id',
	];

	protected $casts = [
		'automaticType' => AutomaticallyCreatedIncidentType::class,
		'datetime_closed' => 'datetime',
		'datetime_created' => 'datetime',
		'state' => IncidentState::class,
	];

	public function monitor(): BelongsTo
	{
		return $this->belongsTo(Monitor::class);
	}

	public function createdBy(): BelongsTo
	{
		return $this->belongsTo(User::class, 'created_by');
	}

	public function closedBy(): BelongsTo
	{
		return $this->belongsTo(User::class, 'closed_by');
	}

	public function assignedTo(): BelongsTo
	{
		return $this->belongsTo(User::class, 'assigned_user_id');
	}

	public function comments(): HasMany
	{
		return $this->hasMany(IncidentComment::class);
	}

	public function history(): HasMany
	{
		return $this->hasMany(IncidentHistory::class);
	}

	public function isClosed(): bool
	{
		return $this->state === IncidentState::CLOSED;
	}

	public function getHistory(): Collection
	{
		$rslt = $this->comments
			->concat($this->history)
			->sortBy('created_at');
		return $rslt;
	}

	public function scopeNotClosed(Builder $query): Builder
	{
		return $query->whereNot('state', IncidentState::CLOSED);
	}
}
