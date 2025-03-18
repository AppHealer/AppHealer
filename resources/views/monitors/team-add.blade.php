@extends(
	'_layouts.app',
	[
		'page' => 'monitors',
		'title' => __(':name : Add team member', ['name' => $monitor->name])
	]
)
@section('content')
	<form class="form" method="post" action="{{route('monitors.team.add.submit', ['monitor' => $monitor])}}">
		@csrf
		<fieldset class="border p-3 mb-3">
			<div class="row mb-2">
				<div class="col-3">
					<label class="col-form-label" for="fieldUser">{{__('User')}}</label>
				</div>
				<div class="col-auto">
					<select name="user" id="fieldUser" class="form-select  {{$errors->has('user') ? 'is-invalid' : ''}}">
						<option disabled selected>{{__('Select user')}}</option>
						@foreach ($users as $user)
							<option value="{{$user->id}}" {{old('user') == $user->id ? 'selected' : ''}}>{{$user->name}}</option>
						@endforeach
					</select>
					@if ($errors->hasAny('user'))
						<div class="invalid-feedback">{{$errors->first('user')}}</div>
					@endif
				</div>
			</div>
			<div class="row">
				<div class="col-3">
					<label class="col-form-label" for="fieldRole">{{__('Role')}}</label>
				</div>
				<div class="col-auto">
					<select name="role" id="fieldRole" class="form-select {{$errors->has('role') ? 'is-invalid' : ''}}" class="w-auto">
						<option disabled selected>{{__('Assign role')}}</option>
						@foreach($roles as $role)
							<option value="{{$role}}" {{old('role') == $role ? 'selected' : ''}}>{{$role}}</option>
						@endforeach
					</select>
					@if ($errors->hasAny('role'))
						<div class="invalid-feedback">{{$errors->first('role')}}</div>
					@endif
				</div>
			</div>
		</fieldset>
		<a href="{{route('monitors.detail', ['monitor' => $monitor])}}" class="btn btnCancel">{{__('Back')}}</a>
		<input type="submit" class="btn" value="{{__('Add member')}}"/>
	</form>
@endsection