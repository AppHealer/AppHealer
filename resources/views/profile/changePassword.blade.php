@extends(
	'_layouts.app',
	[
		'page' => 'profile',
		'title' =>  __('Change password')
	]
)
@section('content')
	<form method="post" action="{{route('profile.changePassword.submit')}}">
		@csrf
		<fieldset class="border mb-3 p-3">
			<div class="row mb-2">
				<div class="col-md-5 col-sm-12">
					<label class="col-form-label" for="fieldCurrentPassword">{{ __('Current password') }}</label>
				</div>
				<div class="col-md-7 col-sm-12">
					<input type="password" name="currentPassword" id="fieldCurrentPassword" class="form-control {{ $errors->has('currentPassword') ? 'is-invalid': '' }}" >
					@if ($errors->hasAny('currentPassword'))
						<div class="invalid-feedback">
							{{  $errors->first('currentPassword') }}
						</div>
					@endif
				</div>
			</div>

			<div class="row mb-2">
				<div class="col-md-5 col-sm-12">
					<label class="col-form-label" for="fieldNewPassword">{{ __('New password') }}</label>
				</div>
				<div class="col-md-7 col-sm-12">
					<input type="password" name="newPassword" id="fieldNewPassword" class="form-control {{ $errors->has('newPassword') ? 'is-invalid': '' }}" >
					@if ($errors->hasAny('newPassword'))
						<div class="invalid-feedback">
							{{  $errors->first('newPassword') }}
						</div>
					@endif
				</div>
			</div>

			<div class="row mb-2">
				<div class="col-md-5 col-sm-12">
					<label class="col-form-label" for="fieldPasswordConfirmation">{{ __('Password confirmation') }}</label>
				</div>
				<div class="col-md-7 col-sm-12">
					<input type="password" name="newPassword_confirmation" id="fieldPasswordConfirmation" class="form-control {{ $errors->has('newPassword_confirmation') ? 'is-invalid': '' }}" >
					@if ($errors->hasAny('newPassword_confirmation'))
						<div class="invalid-feedback">
							{{  $errors->first('newPassword_confirmation') }}
						</div>
					@endif
				</div>
			</div>

		</fieldset>
		<a href="{{route('profile.view')}}" class="btn btnBack">{{__('Back')}}</a>
		<input class="btn" value="{{__('Save')}}" type="submit"/>
	</form>
@endsection