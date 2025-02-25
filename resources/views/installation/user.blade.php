@extends('_layouts.app', ['title' => 'Installation'])
@section('content')
	<div class="content installation">
		<h2>
			{{__('AppHealer is sucessfully configured. ')}}
		</h2>
		<div class="alert alert-info mt-4">
			{{__('We just need to create first user.')}}
		</div>
		<form class="form" method="post" action="{{route('installation.create.user')}}">
			@csrf
			<fieldset class="border p-3 mb-3">
				<legend>{{__('Create first user')}}</legend>

				<div class="row mb-2">
					<div class="col-4">
						<label class="col-form-label" for="name">{{ __('Name') }}</label>
					</div>
					<div class="col-7">
						<input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid': '' }}" value="{{old('name') ?? ($name ?? '')}}">
						@if ($errors->hasAny('name'))
							<div class="invalid-feedback">
								{{  $errors->first('name') }}
							</div>
						@endif
					</div>
				</div>

				<div class="row mb-2">
					<div class="col-4">
						<label class="col-form-label" for="email">{{ __('Email') }}</label>
					</div>
					<div class="col-7">
						<input type="text" name="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid': '' }}" value="{{old('email') ?? ($email ?? '')}}">
						@if ($errors->hasAny('email'))
							<div class="invalid-feedback">
								{{  $errors->first('email') }}
							</div>
						@endif
					</div>
				</div>

				<div class="row mb-2">
					<div class="col-4">
						<label class="col-form-label" for="email">{{ __('Password') }}</label>
					</div>
					<div class="col-7">
						<input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid': '' }}" >
						@if ($errors->hasAny('password'))
							<div class="invalid-feedback">
								{{  $errors->first('password') }}
							</div>
						@endif
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-4">
						<label class="col-form-label" for="password_confirmation">{{ __('Password confirmation') }}</label>
					</div>
					<div class="col-7">
						<input type="password" name="password_confirmation" id="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid': '' }}" >
						@if ($errors->hasAny('password_confirmation'))
							<div class="invalid-feedback">
								{{  $errors->first('password_confirmation') }}
							</div>
						@endif
					</div>
				</div>
			</fieldset>
			<fieldset>
				<div class="row">
					<div class="col text-end">
						 <input type="submit" class="btn" value="{{__('Create user')}}">
					</div>
				</div>
			</fieldset>
		</form>
	</div>
@endsection