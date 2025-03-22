<fieldset class="border p-3 mb-3">
	<legend>{{__('Basic settings')}}</legend>
	<div class="row mb-2">
		<div class="col-md-4 col-sm-12">
			<label class="col-form-label" for="fieldName">{{ __('Monitor name') }}</label>
		</div>
		<div class="col-md-8 col-sm-12">
			<input type="text" name="name" id="fieldName" class="form-control {{ $errors->has('name') ? 'is-invalid': '' }}" value="{{old('name') ?? (isset($monitor) ? $monitor->name : '')}}">
			@if ($errors->hasAny('name'))
				<div class="invalid-feedback">
					{{  $errors->first('name') }}
				</div>
			@endif
		</div>
	</div>
</fieldset>