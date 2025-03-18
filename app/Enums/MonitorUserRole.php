<?php
declare(strict_types=1);

namespace AppHealer\Enums;

enum MonitorUserRole: string
{
	case VIEWER = 'viewer';
	case TESTER = 'tester';
	case DEVELOPER = 'developer';
	case MANAGER = 'manager';
}
