<?php
declare(strict_types=1);

namespace AppHealer\Enums;

enum MonitorUserRole: string
{
	case VIEWER = 'viewer';
	case TESTER = 'tester';
	case DEVELOPER = 'developer';
	case MANAGER = 'manager';

	public function canEdit(): bool
	{
		return match ($this) {
			self::DEVELOPER => true,
			self::MANAGER => true,
			default => false,
		};
	}

	public function canRun(): bool
	{
		return match ($this) {
			self::VIEWER => false,
			default => true,
		};
	}

	public function canManageTeam(): bool
	{
		return match ($this) {
			self::MANAGER => true,
			default => false,
		};
	}

	public function canDelete(): bool
	{
		return match ($this) {
			self::MANAGER => true,
			default => false,
		};
	}

	public function canCreateIncident(): bool
	{
		return match ($this) {
			self::VIEWER => false,
			default => true,
		};
	}
}
