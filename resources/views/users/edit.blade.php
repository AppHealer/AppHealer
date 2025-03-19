@extends(
	'_layouts.app',
	 [
		'page' => 'users',
		'title' => isset($user) ?  __('Edit user :name', ['name' => $user->name]) : __('New user')
	]
)
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
		<fieldset class="border mb-3 p-3">
			<legend>Privileges</legend>
			<div class="row mb-2">
				<div class="col-md-4 col-sm-12">
					<label class="col-form-label" for="fieldPhone">{{ __('Privileges type') }}</label>
				</div>
				<div class="col-md-8 col-sm-12">
					<div class="form-check">
						<input class="form-check-input" type="radio" name="admin" value="0" id="fieldPrivStandardUser" {{(old('admin') === "0" || (old('admin') === null && isset($user) && $user->admin == 0)) ? 'checked' : ''}}>
						<label class="form-check-label" for="fieldPrivStandardUser">{{__('Standard user')}}</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" name="admin" value="1" id="fieldPrivAdminUser"  {{(old('admin') === "1" || (old('admin') === null && isset($user) && $user->admin == 1)) ? 'checked' : ''}}>
						<label class="form-check-label" for="fieldPrivAdminUser">{{__('Administrator')}}</label>
					</div>
				</div>
			</div>
		</fieldset>
		<a class="btn btnBack" href="{{route('users')}}">{{__('Back')}}</a>
		<input type="hidden" name="page" value="{{$pagingPage}}">
		<input type="submit" class="btn btn-primary" value="{{ __('Save user')  }}">
	</form>
@endsection