@extends(
	'_layouts.app',
	 [
		'page' => 'users',
		'title' => isset($user) ?  __('Edit user :name', ['name' => $user->name]) : __('New user')
	]
)
@php
	use AppHealer\Enums\GlobalPrivilegesGroup;
	use AppHealer\Enums\GlobalPrivilegesAction;
@endphp
@section('content')
	<form method="post" action="{{isset($user)? route('users.edit.save', ['user' => $user->id ]) : route('users.edit.save.new')}}">
		@csrf
		<fieldset class="border mb-3 p-3">
			<legend>{{__('User data')}}</legend>
			<div class="row mb-2">
				<div class="col-md-4 col-sm-12">
					<label class="col-form-label" for="fieldName">{{ __('Name') }}</label>
				</div>
				<div class="col-md-8 col-sm-12">
					<input type="text" name="name" id="fieldName" class="form-control {{ $errors->has('name') ? 'is-invalid': '' }}" value="{{old('name') ?? (isset($user) ? $user->name : '')}}">
					@if ($errors->hasAny('name'))
						<div class="invalid-feedback">
							{{  $errors->first('name') }}
						</div>
					@endif
				</div>
			</div>
			<div class="row mb-2">
				<div class="col-md-4 col-sm-12">
					<label class="col-form-label" for="fieldEmail">{{ __('Email') }}</label>
				</div>
				<div class="col-md-8 col-sm-12">
					<input type="text" name="email" id="fieldEmail" class="form-control {{ $errors->has('email') ? 'is-invalid': '' }}" value="{{old('email') ?? (isset($user) ? $user->email : '')}}">
					@if ($errors->hasAny('email'))
						<div class="invalid-feedback">
							{{  $errors->first('email') }}
						</div>
					@endif
				</div>
			</div>
			<div class="row mb-2">
				<div class="col-md-4 col-sm-12">
					<label class="col-form-label" for="fieldPhone">{{ __('Phone number') }}</label>
				</div>
				<div class="col-md-8 col-sm-12">
					<input type="text" name="phone" id="fieldPhone" class="form-control {{ $errors->has('phone') ? 'is-invalid': '' }}" value="{{old('phone') ?? (isset($user) ? $user->phone : '')}}">
					@if ($errors->hasAny('phone'))
						<div class="invalid-feedback">
							{{  $errors->first('phone') }}
						</div>
					@endif
				</div>
			</div>
		</fieldset>

		<fieldset class="border mb-3 p-3 js-user-privileges">
			<legend>Privileges</legend>
			<div class="row mb-2">
				<div class="col-md-4 col-sm-12">
					<label class="col-form-label" for="fieldPhone">{{ __('Privileges type') }}</label>
				</div>
				<div class="col-md-8 col-sm-12">
					<div class="form-check">
						<input class="form-check-input js-user-type-standard-control" type="radio" name="admin" value="0" id="fieldPrivStandardUser"
							{{ !isset($user)|| (old('admin') === "0" || (old('admin') === null && isset($user) && $user->admin == 0)) ? 'checked' : ''}}
						>
						<label class="form-check-label" for="fieldPrivStandardUser">{{__('Standard user')}}</label>
					</div>
					<div class="form-check">
						<input class="form-check-input js-user-type-administrator-control" type="radio" name="admin" value="1" id="fieldPrivAdminUser" {{(old('admin') === "1" || (old('admin') === null && isset($user) && $user->admin == 1)) ? 'checked' : ''}}>
						<label class="form-check-label" for="fieldPrivAdminUser">{{__('Administrator')}}</label>
					</div>
				</div>
			</div>
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
		</fieldset>
		<a class="btn btnBack" href="{{route('users')}}">{{__('Back')}}</a>
		<input type="hidden" name="page" value="{{$pagingPage}}">
		<input type="submit" class="btn btn-primary" value="{{ __('Save user')  }}">
	</form>
@endsection