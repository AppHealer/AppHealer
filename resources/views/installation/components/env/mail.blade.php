<fieldset class="border p-3">
	<legend>{{__('SMTP  Mail settings')}}</legend>
	<div class="alert alert-info">
		For SMTP server settings, view your mail provider's documentation.
	</div>

	<div class="row mb-2">
		<div class="col-3">
			<label class="col-form-label" for="smtpHost">{{ __('Host') }}</label>
		</div>
		<div class="col-6">
			<input type="text" name="smtpHost" id="smtpHost" class="form-control {{ $errors->has('smtpHost') ? 'is-invalid': '' }}" value="{{old('smtpHost') ?? ($smtpHost ?? '')}}">
			@if ($errors->hasAny('smtpHost'))
				<div class="invalid-feedback">
					{{  $errors->first('smtpHost') }}
				</div>
			@endif
		</div>
	</div>
	<div class="row mb-2">
		<div class="col-3">
			<label class="col-form-label" for="smtpHost">{{ __('Port') }}</label>
		</div>
		<div class="col-3">
			<input type="number" min="1" max="9999" name="smtpPort" id="smtpPort" class="form-control {{ $errors->has('smtpPort') ? 'is-invalid': '' }}" value="{{old('smtpPort') ?? ($smtpPort ?? 587)}}">
			@if ($errors->hasAny('smtpPort'))
				<div class="invalid-feedback">
					{{  $errors->first('smtpPort') }}
				</div>
			@endif
		</div>
	</div>

	<div class="row mb-2">
		<div class="col-3">
			<label class="col-form-label" for="smtpUser">{{ __('User') }}</label>
		</div>
		<div class="col-8">
			<input type="text" name="smtpUser" id="smtpUser" class="form-control {{ $errors->has('smtpUser') ? 'is-invalid': '' }}" value="{{old('smtpUser') ?? ($smtpUser ?? '')}}">
			@if ($errors->hasAny('smtpUser'))
				<div class="invalid-feedback">
					{{  $errors->first('smtpUser') }}
				</div>
			@endif
		</div>
	</div>

	<div class="row mb-2">
		<div class="col-3">
			<label class="col-form-label" for="smtpPassword">{{ __('Password') }}</label>
		</div>
		<div class="col-8">
			<input type="password" name="smtpPassword" id="smtpPassword" class="form-control {{ $errors->has('smtpPassword') ? 'is-invalid': '' }}" value="{{old('smtpPassword') ?? ($smtpPassword ?? '')}}">
			@if ($errors->hasAny('smtpPassword'))
				<div class="invalid-feedback">
					{{  $errors->first('smtpPassword') }}
				</div>
			@endif
		</div>
	</div>

	<div class="row mb-2">
		<div class="col-3">
			<label class="col-form-label" for="smtpSender">{{ __('Send from') }}</label>
		</div>
		<div class="col-8">
			<input type="text" name="smtpSender" id="smtpSender" class="form-control {{ $errors->has('smtpSender') ? 'is-invalid': '' }}" value="{{old('smtpSender') ?? ($smtpSender ?? '')}}">
			@if ($errors->hasAny('smtpSender'))
				<div class="invalid-feedback">
					{{  $errors->first('smtpSender') }}
				</div>
			@endif
		</div>
	</div>
</fieldset>