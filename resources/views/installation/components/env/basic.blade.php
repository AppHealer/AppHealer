<fieldset class="border p-3 mb-3">
	<legend>{{__('Basic settings')}}</legend>
	<div class="row mb-2">
		<div class="col-4">
			<label class="col-form-label" for="appurl">{{ __('AppHealer url') }}</label>
		</div>
		<div class="col-8">
			<input type="text" name="appurl" id="appurl" class="form-control {{ $errors->has('appurl') ? 'is-invalid': '' }}" value="{{old('appurl') ?? ($appurl ?? '')}}">
			@if ($errors->hasAny('appurl'))
				<div class="invalid-feedback">
					{{  $errors->first('appurl') }}
				</div>
			@endif
		</div>
	</div>
	<div class="row mb-2">
		<div class="col-4">
			<label class="col-form-label" for="timezone">{{ __('Timezone') }}</label>
		</div>
		<div class="col-8">
			<select name="timezone" id="timezone" class="form-control form-select">
				@foreach (require base_path() . '/app//data/timezones.php' as $timezone_row)
					<option
							@if (old('timezone') == $timezone_row || $timezone == $timezone_row)
								selected
							@endif
					>
						{{$timezone_row}}
					</option>
				@endforeach
			</select>
		</div>
	</div>
</fieldset>