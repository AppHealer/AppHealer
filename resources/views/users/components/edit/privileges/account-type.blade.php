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