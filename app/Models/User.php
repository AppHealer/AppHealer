<?php
declare(strict_types = 1);

namespace AppHealer\Models;

use AppHealer\Notifications\Users\PasswordReset;
use Carbon\Carbon;
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
		'blocked',
		'email',
		'name',
		'password',
		'phone',
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

	/**
	 * Get the attributes that should be cast.
	 *
	 * @return array<string, string>
	 */
	protected function casts(): array
	{
		return [
			'blocked' => 'boolean',
			'email_verified_at' => 'datetime',
			'password' => 'hashed',
		];
	}

	public function sendPasswordResetNotification($token): void
	{
		$this->notify(new PasswordReset($token));
	}
}
