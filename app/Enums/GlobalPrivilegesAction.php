<?php
declare(strict_types=1);

namespace AppHealer\Enums;

enum GlobalPrivilegesAction: string
{
	case CREATE = 'create';
	case VIEW_ALL = 'view-all';
	case EDIT_ALL = 'edit-all';
	case DELETE_ALL = 'delete-all';
	case RUN_ALL = 'run-all';
	case TEAM_ALL = 'team-all';
}
