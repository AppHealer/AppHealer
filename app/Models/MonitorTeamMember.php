<?php
declare(strict_types=1);

namespace AppHealer\Models;

use AppHealer\Enums\MonitorUserRole;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MonitorTeamMember extends Pivot
{

	protected $table = 'monitor_teams';

	protected $casts = [
		'role' => MonitorUserRole::class,
	];
}
