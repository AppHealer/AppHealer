@php
	use AppHealer\Enums\GlobalPrivilegesGroup;
	use AppHealer\Enums\GlobalPrivilegesAction;
@endphp

@if(
	auth()->user()->admin
	|| auth()->user()->hasGlobalPrivilege(GlobalPrivilegesGroup::MONITORS, GlobalPrivilegesAction::RUN_ALL)
	|| auth()->user()->getRoleInMonitor($monitor)?->canRun()
)
	<a class="btn" href="{{route('monitors.schedule', ['monitor' => $monitor])}}">{{__('Check now')}}</a>
@endif

@if(
	auth()->user()->admin
	|| auth()->user()->hasGlobalPrivilege(GlobalPrivilegesGroup::MONITORS, GlobalPrivilegesAction::INCIDENT_CREATE)
	|| auth()->user()->getRoleInMonitor($monitor)?->canCreateIncident()
)
	<a class="btn" href="{{route('monitors.incidents.create', ['monitor' => $monitor])}}">{{__('New incident')}}</a>
@endif

<a class="btn" href="{{route('incidents')}}?monitor={{$monitor->id}}">{{__('Incidents')}}</a>


<a class="btn" href="{{route('monitors.team', ['monitor' => $monitor])}}">
	@if(
		auth()->user()->admin
		|| auth()->user()->hasGlobalPrivilege(GlobalPrivilegesGroup::MONITORS, GlobalPrivilegesAction::TEAM_ALL)
		|| auth()->user()->getRoleInMonitor($monitor)?->canManageTeam()
	)
		{{__('Manage team')}}
	@else
		{{__('View team')}}
	@endif
</a>

@if(
	auth()->user()->admin
	|| auth()->user()->hasGlobalPrivilege(GlobalPrivilegesGroup::MONITORS, GlobalPrivilegesAction::EDIT_ALL)
	|| auth()->user()->getRoleInMonitor($monitor)?->canEdit()
)
	<a class="btn" href="{{route('monitors.edit', ['monitor' => $monitor])}}">{{__('Edit monitor')}}</a>
@endif
