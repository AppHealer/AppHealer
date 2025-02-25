<?php
declare(strict_types=1);

namespace AppHealer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserLoginAudit extends Model
{
	protected $table = 'users_login_audit';

	public $timestamps = true;
	protected $fillable = [
		'browser',
		'failed',
		'ip_address',
		'system',
	];

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	/**
	 * @return string[]
	 */
	protected function casts(): array
	{
		return [
			'eventtime' => 'datetime',
		];
	}
}
