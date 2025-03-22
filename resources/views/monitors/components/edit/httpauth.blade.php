<fieldset class="border p-3 mb-3">
	<legend>HTTP Basic Auth</legend>
	<div class="row mb-2">
		<div class="col-md-4 col-sm-12">
			<label class="col-form-label" for="fieldHttpAuthUser">{{ __('Username') }}</label>
		</div>
		<div class="col-md-8 col-sm-12">
			<input class="form-control" id="fieldHttpAuthUser" name="httpBasicAuthUser" type="text" value="{{old('httpBasicAuthUser') ?? (isset($monitor) ? $monitor->httpBasicAuthUser : '')}}"/>
		</div>
	</div>
	<div class="row mb-2">
		<div class="col-md-4 col-sm-12">
			<label class="col-form-label" for="fieldHttpAuthPassword">{{ __('Password') }}</label>
		</div>
		<div class="col-md-8 col-sm-12">
			<div class="input-group show-password">
				<input class="form-control" id="fieldHttpAuthPassword" name="httpBasicAuthPassword" type="password" value="{{old('httpBasicAuthPassword') ?? (isset($monitor) ? $monitor->httpBasicAuthPassword : '')}}"/>
				<span class="wrapper input-group-addon rounded-end-2 "><span class="fa fa-eye"></span></span>
			</div>
		</div>
	</div>
</fieldset>