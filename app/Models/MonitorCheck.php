<?php
declare(strict_types=1);

namespace AppHealer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MonitorCheck extends Model
{
	protected $table = 'monitor_checks';

	public $timestamps = true;

	protected $fillable = [
		'eventtime',
		'failed',
		'monitor_id',
		'statuscode',
		'timeout',
	];

	/**
	 * @return string[]
	 */
	public function casts(): array
	{
		return [
			'eventtime' => 'datetime',
			'failed'  => 'boolean',
		];
	}

	public function monitor(): BelongsTo
	{
		return $this->belongsTo(Monitor::class);
	}
}
