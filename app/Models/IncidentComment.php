<?php
declare(strict_types=1);

namespace AppHealer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IncidentComment extends Model
{

	protected $table = 'incident_comments';

	protected $casts = [];

	protected $fillable = [
		'incident_id',
		'comment',
		'created_by',
	];

	public function incident(): BelongsTo
	{
		return $this->belongsTo(Incident::class);
	}

	public function createdBy(): BelongsTo
	{
		return $this->belongsTo(User::class, 'created_by');
	}
}
