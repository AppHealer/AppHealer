<?php
declare(strict_types = 1);

namespace AppHealer\Models;

use AppHealer\Enums\MonitorUserRole;
use AppHealer\Notifications\Users\PasswordReset;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticapable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;

class User extends Authenticapable
{

	use HasFactory, Notifiable, HasRolesAndAbilities;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var list<string>
	 */
	protected $fillable = [
		'admin',
		'blocked',
		'email',
		'name',
		'password',
		'phone',
		'privileges',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var list<string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	public function loginAuditlog(): hasMany
	{
		return $this->hasMany(UserLoginAudit::class)
			->orderBy('created_at', 'desc');
	}

	public function getLastLoginAttribute(): ?Carbon
	{
		return $this->loginAuditlog()
			->where('failed', false)
			->first()?->eventtime;
	}

	public function hasGlobalPrivilege(
		string $group,
		string $privilege
	): bool
	{
		return (
			array_key_exists($group, $this->privileges) // @phpstan-ignore-line
			&& array_key_exists($privilege, $this->privileges[$group])
			&& $this->privileges[$group][$privilege] == 1
		);
	}

	public function monitorTeamRoles(): HasMany
	{
		return $this->hasMany(MonitorTeamMember::class);
	}

	public function getRoleInMonitor(
		Monitor $monitor
	): ?MonitorUserRole
	{
		return $this->monitorTeamRoles()
			->where('monitor_id', $monitor->id)
			->first()
			?->role;
	}

	public function monitors(): Builder
	{
		if (
			$this->admin == true
			|| $this->hasGlobalPrivilege('monitors', 'view-all')
		) {
			return Monitor::query();
		}
		return Monitor::query()
			->whereIn(
				'id',
				MonitorTeamMember::query()->where(
					'user_id',
					$this->id
				)->get('monitor_id')
			);
	}

	/**
	 * Get the attributes that should be cast.
	 *
	 * @return array<string, string>
	 */
	protected function casts(): array
	{
		return [
			'admin' => 'boolean',
			'blocked' => 'boolean',
			'email_verified_at' => 'datetime',
			'password' => 'hashed',
			'privileges' => 'array',
		];
	}

	public function sendPasswordResetNotification($token): void
	{
		$this->notify(new PasswordReset($token));
	}
}
