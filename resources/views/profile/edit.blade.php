@extends(
	'_layouts.app',
	 [
		'page' => 'profile',
		'title' =>  __('My profile')
	]
)
@section('content')
	<form class="form" method="post" action="{{route('profile.edit.submit')}}">
		@csrf
		<fieldset class="border mb-3 p-3">
			<div class="row mb-2">
				<div class="col-4">
					<label class="col-form-label" for="fieldName">{{ __('Name') }}</label>
				</div>
				<div class="col-auto">
					<input type="text" name="name" id="fieldName" class="form-control {{ $errors->has('name') ? 'is-invalid': '' }}" value="{{old('name') ?? $profile->name}}">
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
					<input type="text" name="email" id="fieldEmail" class="form-control {{ $errors->has('email') ? 'is-invalid': '' }}" value="{{old('email') ?? $profile->email}}">
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
					<input type="text" name="phone" id="fieldPhone" class="form-control {{ $errors->has('phone') ? 'is-invalid': '' }}" value="{{old('phone') ?? $profile->phone}}">
					@if ($errors->hasAny('phone'))
						<div class="invalid-feedback">
							{{  $errors->first('phone') }}
						</div>
					@endif
				</div>
			</div>
		</fieldset>
		<div class="row">
			<div class="col">
				<a href="{{route('profile.view')}}" class="btn btnBack">{{__('Back')}}</a>
				<input type="submit" class="btn" value="{{__('Save')}}">
			</div>
		</div>
	</form>
@endsection