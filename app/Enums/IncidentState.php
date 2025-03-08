<?php
declare(strict_types=1);

namespace AppHealer\Enums;

enum IncidentState: string
{
	case NEW = 'new';
	case CONFIRMED = 'confirmed';
	case INVESTIGATING = 'investigating';
	case FIXING = 'fixing';
	case MONITORING = 'monitoring';
	case CLOSED = 'closed';
}
