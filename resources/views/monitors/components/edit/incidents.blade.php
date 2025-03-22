<fieldset class="border p-3 mb-3">
	<legend>{{__('Incident management')}}</legend>
	<div class="row mb-2">
		<div class="col-8" >
			<label class="col-form-label" for="fieldIncidentCreateAfterCount">{{__('Create after count of failures')}}</label>
		</div>
		<div class="col-4">
			<input type="number" class="form-control {{ $errors->has('incidentCreateCount') ? 'is-invalid': '' }} " min="0" max="20" name="incidentCreateCount" id="fieldIncidentCreateAfterCount" value="{{old('incidentCreateCount') ?? (isset($monitor) ? $monitor->incidentCreateCount : '')}}"/>
			@if ($errors->hasAny('incidentCloseCount'))
				<div class="invalid-feedback">{{$errors->first('incidentCreateCount')}}</div>
			@endif
		</div>
	</div>


	<div class="row mb-2">
		<div class="col-8">
			<label class="col-form-label" for="fieldIncidentCloseAfterCount">{{__('Close after count of success')}}</label>
		</div>
		<div class="col-4">
			<input type="number" class="{{ $errors->has('incidentCloseCount') ? 'is-invalid': '' }} form-control" min="0" max="20" name="incidentCloseCount" id="fieldCloseIncidentAfterCount" value="{{old('incidentCloseCount') ?? (isset($monitor) ? $monitor->incidentCloseCount : '')}}"/>
			@if ($errors->hasAny('incidentCloseCount'))
				<div class="invalid-feedback">{{$errors->first('incidentCloseCount')}}</div>
			@endif
		</div>

	</div>

	<div class="row mb-2">
		<div class="col-8">
			<label class="col-form-label" for="fieldIncidentCreateAfterAvg">{{__('Create when last 10 avg timeout over ms')}}</label>
		</div>
		<div class="col-4">
			<input type="number" class="form-control {{ $errors->has('incidentCreateAvg') ? 'is-invalid': '' }}" min="0" max="10000" name="incidentCreateAvg" id="fieldIncidentCreateAfterAvg" value="{{old('incidentCreateAvg') ?? (isset($monitor) ? $monitor->incidentCreateAvg : '')}}"/>
			@if ($errors->hasAny('incidentCreateAvg'))
				<div class="invalid-feedback">{{$errors->first('incidentCreateAvg')}}</div>
			@endif
		</div>
	</div>

	<div class="row mb-2">
		<div class="col-8">
			<label class="col-form-label" for="fieldIncidentCloseAfterAvg">{{__('Close when last 10 avg below over ms')}}</label>
		</div>
		<div class="col-4">
			<input type="number" class="form-control {{ $errors->has('incidentCloseAvg') ? 'is-invalid': '' }}" min="0" max="10000" step="100" name="incidentCloseAvg" id="fieldIncidentCloseAfterAvg" value="{{old('incidentCloseAvg') ?? (isset($monitor) ? $monitor->incidentCloseAvg : '')}}"/>
			@if ($errors->hasAny('incidentCloseAvg'))
				<div class="invalid-feedback">{{$errors->first('incidentCloseAvg')}}</div>
			@endif
		</div>
	</div>

	<div class="row mb-2">
		<div class="col-md-5 col-12">
			<label class="col-form-label" for="fieldNotificationEmail">{{__('Send notification to')}}</label>
		</div>
		<div class="col-md-7 col-12">
			<input type="text" class="form-control {{ $errors->has('notificationEmail') ? 'is-invalid': '' }}"  name="notificationEmail" id="fieldNotificationEmail" value="{{old('notificationEmail') ?? (isset($monitor) ? $monitor->notificationEmail : '')}}"/>
			@if ($errors->hasAny('notificationEmail'))
				<div class="invalid-feedback">{{$errors->first('notificationEmail')}}</div>
			@endif
		</div>
	</div>
</fieldset>