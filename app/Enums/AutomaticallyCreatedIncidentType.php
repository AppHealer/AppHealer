<?php
declare(strict_types=1);

namespace AppHealer\Enums;

enum AutomaticallyCreatedIncidentType: string
{
	case AVG = 'AVG';
	case COUNT = 'COUNT';
}
