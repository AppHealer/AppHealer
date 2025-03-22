@if(
	auth()->user()->admin
	|| auth()->user()->hasGlobalPrivilege(GlobalPrivilegesGroup::MONITORS, GlobalPrivilegesAction::EDIT_ALL)
	|| auth()->user()->getRoleInMonitor($monitor)?->canEdit()
)
	<a class="btn" href="{{route('monitors.edit', ['monitor' => $monitor])}}">{{__('Edit monitor')}}</a>
@endif
@if(
	auth()->user()->admin
	|| auth()->user()->hasGlobalPrivilege(GlobalPrivilegesGroup::MONITORS, GlobalPrivilegesAction::RUN_ALL)
	|| auth()->user()->getRoleInMonitor($monitor)?->canRun()
)
	<a class="btn" href="{{route('monitors.schedule', ['monitor' => $monitor])}}">{{__('Check now')}}</a>
@endif
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
</div>