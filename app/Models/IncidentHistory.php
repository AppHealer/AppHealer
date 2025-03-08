<?php
declare(strict_types=1);

namespace AppHealer\Models;

use AppHealer\Enums\IncidentState;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IncidentHistory extends Model
{
	protected $table = 'incident_history';

	protected $casts = [
		'state' => IncidentState::class,
		'prev_state' => IncidentState::class,

	];

	protected $fillable = [
		'incident_id',
		'created_by',
		'assigned_user_id',
		'prev_assigned_user_id',
	];

	public function incident(): BelongsTo
	{
		return $this->belongsTo(Incident::class);
	}

	public function createdBy(): BelongsTo
	{
		return $this->belongsTo(User::class, 'created_by');
	}

	public function assignedUser(): BelongsTo
	{
		return $this->belongsTo(User::class, 'assigned_user_id');
	}

	public function prevAssignedUser(): BelongsTo
	{
		return $this->belongsTo(User::class, 'prev_assigned_user_id');
	}
}
