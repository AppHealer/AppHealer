<?php
declare(strict_types=1);

namespace AppHealer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Incident extends Model
{
	protected $table = 'incidents';

	protected $fillable = [
		'assigned_user_id',
		'caption',
		'closed_by',
		'created_by',
		'datetime_closed',
		'monitor_id',
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

	public function getHistory(): Collection
	{
		$rslt = $this->history
			->merge($this->comments)
			->sortBy('datetime_created');
		return $rslt;

	}
}
