@php
	use AppHealer\Enums\GlobalPrivilegesGroup;
	use AppHealer\Enums\GlobalPrivilegesAction;
@endphp
<div class="row mb-2 js-user-type-standard {{(old('admin') === "1" || (old('admin') === null && isset($user) && $user->admin == 1)) ? 'd-none' : ''}}">
	<div class="col-md-4 col-sm-12">
		Monitors
	</div>
	<div class="col-md-8 col-sm-12">
		<div class="form-check">
			<input type="hidden" name="privileges[{{GlobalPrivilegesGroup::MONITORS->value}}][create]" value="0">
			<input class="form-check-input" type="checkbox" name="privileges[{{GlobalPrivilegesGroup::MONITORS->value}}][create]" value="1"  id="fieldPrivMonitorCreate"
					{{
						(
							is_array(old('privileges'))
							&& old('privileges')[GlobalPrivilegesGroup::MONITORS->value]['create'] === '1'
						) || (
							old('privileges') === null
							&& isset($user)
							&& $user->hasGlobalPrivilege(GlobalPrivilegesGroup::MONITORS, GlobalPrivilegesAction::CREATE)
						) ? 'checked' :''
					}}
			>
			<label class="form-check-label" for="fieldPrivMonitorCreate">{{__('Create')}}</label>
		</div>
		<div class="form-check">
			<input type="hidden" name="privileges[{{GlobalPrivilegesGroup::MONITORS->value}}][{{GlobalPrivilegesAction::VIEW_ALL->value}}]" value="0">
			<input class="form-check-input js-privileges-monitors-viewall-control" type="checkbox" name="privileges[{{GlobalPrivilegesGroup::MONITORS->value}}][{{GlobalPrivilegesAction::VIEW_ALL->value}}]" value="1" id="fieldPrivMonitorViewAll"
					{{
						(
							is_array(old('privileges'))
							&& old('privileges')[GlobalPrivilegesGroup::MONITORS->value][GlobalPrivilegesAction::VIEW_ALL->value] === '1'
							&& old('admin') === '0'
						) || (
							old('privileges') === null
							&& isset($user)
							&& $user->admin === false
							&& $user->hasGlobalPrivilege(GlobalPrivilegesGroup::MONITORS, GlobalPrivilegesAction::VIEW_ALL)
						) ? 'checked' : ''
					}}
			>
			<label class="form-check-label" for="fieldPrivMonitorViewAll">{{__('View all')}}</label>
		</div>
		<div class="form-check">
			<input type="hidden" name="privileges[{{GlobalPrivilegesGroup::MONITORS->value}}][GlobalPrivilegesAction::EDIT_ALL->value]" value="0">
			<input class="form-check-input js-privileges-monitors-viewall-dependent" type="checkbox" name="privileges[{{GlobalPrivilegesGroup::MONITORS->value}}][{{GlobalPrivilegesAction::EDIT_ALL->value}}]" value="1"  id="fieldPrivMonitorEditAll"
					{{
						(
							is_array(old('privileges'))
							&& old('privileges')[GlobalPrivilegesGroup::MONITORS->value][GlobalPrivilegesAction::EDIT_ALL->value] === '1'
						) || (
							old('privileges') === null
							&& isset($user)
							&& $user->hasGlobalPrivilege(GlobalPrivilegesGroup::MONITORS, GlobalPrivilegesAction::EDIT_ALL)
						) ? 'checked' : ''
					}}

					{{
						(
							is_array(old('privileges'))
							&& (old('admin') === '0')
							&& old('privileges')[GlobalPrivilegesGroup::MONITORS->value][GlobalPrivilegesAction::VIEW_ALL->value] === '0'
						) || (
							old('privileges') === null
							&& isset($user)
							&& !$user->hasGlobalPrivilege(GlobalPrivilegesGroup::MONITORS, GlobalPrivilegesAction::VIEW_ALL)
						) || (
							!isset($user)
						) ? 'disabled' : ''
					}}
			>
			<label class="form-check-label" for="fieldPrivMonitorEditAll">{{__('Edit all')}}</label>
		</div>
		<div class="form-check">
			<input type="hidden" name="privileges[{{GlobalPrivilegesGroup::MONITORS->value}}][{{GlobalPrivilegesAction::DELETE_ALL->value}}]" value="0">
			<input class="form-check-input js-privileges-monitors-viewall-dependent" type="checkbox" name="privileges[{{GlobalPrivilegesGroup::MONITORS->value}}][{{GlobalPrivilegesAction::DELETE_ALL->value}}]" value="1"  id="fieldPrivMonitorDeleteAll"
					{{
						(
							is_array(old('privileges'))
							&& (old('admin') === '0')
							&& old('privileges')[GlobalPrivilegesGroup::MONITORS->value][GlobalPrivilegesAction::DELETE_ALL->value] === '1'
						) || (
							old('privileges') === null
							&& isset($user)
							&& $user->admin == false

							&& $user->hasGlobalPrivilege(GlobalPrivilegesGroup::MONITORS, GlobalPrivilegesAction::DELETE_ALL)
						) ? 'checked' : ''
					}}

					{{
						(
							is_array(old('privileges'))
							&& old('privileges')[GlobalPrivilegesGroup::MONITORS->value][GlobalPrivilegesAction::VIEW_ALL->value] == '0'
						) || (
							old('privileges') === null
							&& isset($user)
							&& !$user->hasGlobalPrivilege(GlobalPrivilegesGroup::MONITORS, GlobalPrivilegesAction::VIEW_ALL)
						) || (!isset($user))
						? 'disabled' : ''
					}}
			>
			<label class="form-check-label" for="fieldPrivMonitorDeleteAll">{{__('Delete all')}}</label>
		</div>

		<div class="form-check">
			<input type="hidden" name="privileges[{{GlobalPrivilegesGroup::MONITORS->value}}][{{GlobalPrivilegesAction::TEAM_ALL->value}}]" value="0">
			<input class="form-check-input js-privileges-monitors-viewall-dependent" type="checkbox" name="privileges[{{GlobalPrivilegesGroup::MONITORS->value}}][{{GlobalPrivilegesAction::TEAM_ALL->value}}]" value="1"  id="fieldPrivMonitorTeamAll"
					{{
						(
							is_array(old('privileges'))
							&& (old('admin') === '0')
							&& old('privileges')[GlobalPrivilegesGroup::MONITORS->value][GlobalPrivilegesAction::TEAM_ALL->value] === '1'
						) || (
							old('privileges') === null
							&& isset($user)
							&& $user->admin === false
							&& $user->hasGlobalPrivilege(GlobalPrivilegesGroup::MONITORS, GlobalPrivilegesAction::TEAM_ALL)
						) ? 'checked' : ''
					}}

					{{
						(
							is_array(old('privileges'))
							&& old('privileges')[GlobalPrivilegesGroup::MONITORS->value][GlobalPrivilegesAction::VIEW_ALL->value] == '0'
						) || (
							old('privileges') === null
							&& isset($user)
							&& !$user->hasGlobalPrivilege(GlobalPrivilegesGroup::MONITORS, GlobalPrivilegesAction::VIEW_ALL)
						) || (!isset($user))
						? 'disabled' : ''
					}}
			>
			<label class="form-check-label" for="fieldPrivMonitorTeamAll">{{__('Manage all teams')}}</label>
		</div>

		<div class="form-check">
			<input type="hidden" name="privileges[{{GlobalPrivilegesGroup::MONITORS->value}}][{{GlobalPrivilegesAction::RUN_ALL->value}}]" value="0">
			<input class="form-check-input js-privileges-monitors-viewall-dependent" type="checkbox" name="privileges[{{GlobalPrivilegesGroup::MONITORS->value}}][{{GlobalPrivilegesAction::RUN_ALL->value}}]" value="1"  id="fieldPrivMonitorRunAll"
					{{
						(
							is_array(old('privileges'))
							&& (old('admin') === '0')
							&& old('privileges')[GlobalPrivilegesGroup::MONITORS->value][GlobalPrivilegesAction::RUN_ALL->value] === '1'
						) || (
							old('privileges') === null
							&& isset($user)
							&& $user->admin === false
							&& $user->hasGlobalPrivilege(GlobalPrivilegesGroup::MONITORS, GlobalPrivilegesAction::RUN_ALL)
						) ? 'checked' : ''
					}}

					{{
						(
							is_array(old('privileges'))
							&& old('privileges')[GlobalPrivilegesGroup::MONITORS->value][GlobalPrivilegesAction::VIEW_ALL->value] == '0'
						) || (
							old('privileges') === null
							&& isset($user)
							&& !$user->hasGlobalPrivilege(GlobalPrivilegesGroup::MONITORS, GlobalPrivilegesAction::VIEW_ALL)
						) || (!isset($user))
						? 'disabled' : ''
					}}
			>
			<label class="form-check-label" for="fieldPrivMonitorRunAll">{{__('Run all checks')}}</label>
		</div>
	</div>
</div>