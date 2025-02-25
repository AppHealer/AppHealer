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
				<div class="col-4">
					<label class="col-form-label" for="fieldName">{{ __('Name') }}</label>
				</div>
				<div class="col-auto">
					<input type="text" name="name" id="fieldName" class="form-control {{ $errors->has('name') ? 'is-invalid': '' }}" value="{{old('name') ?? (isset($user) ? $user->name : '')}}">
					@if ($errors->hasAny('name'))
						<div class="invalid-feedback">
							{{  $errors->first('name') }}
						</div>
					@endif
				</div>
			</div>
			<div class="row mb-2">
				<div class="col-4">
					<label class="col-form-label" for="fieldEmail">{{ __('Email') }}</label>
				</div>
				<div class="col-auto">
					<input type="text" name="email" id="fieldEmail" class="form-control {{ $errors->has('email') ? 'is-invalid': '' }}" value="{{old('email') ?? (isset($user) ? $user->email : '')}}">
					@if ($errors->hasAny('email'))
						<div class="invalid-feedback">
							{{  $errors->first('email') }}
						</div>
					@endif
				</div>
			</div>
			<div class="row mb-2">
				<div class="col-4">
					<label class="col-form-label" for="fieldPhone">{{ __('Phone number') }}</label>
				</div>
				<div class="col-auto">
					<input type="text" name="phone" id="fieldPhone" class="form-control {{ $errors->has('phone') ? 'is-invalid': '' }}" value="{{old('phone') ?? (isset($user) ? $user->phone : '')}}">
					@if ($errors->hasAny('phone'))
						<div class="invalid-feedback">
							{{  $errors->first('phone') }}
						</div>
					@endif
				</div>
			</div>
		</fieldset>
		<a class="btn btnBack" href="{{route('users')}}">{{__('Back')}}</a>
		<input type="hidden" name="page" value="{{$pagingPage}}">
		<input type="submit" class="btn btn-primary" value="{{ __('Save user')  }}">
	</form>
@endsection