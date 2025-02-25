<?php
declare(strict_types=1);

namespace AppHealer\Models;

use Illuminate\Database\Eloquent\Model;

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
}
