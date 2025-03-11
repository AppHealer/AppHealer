<form class="row form mb-2" method="get">
	<div class="col-auto">
		<label class="d-block" for="fieldState">{{__('State')}}</label>
		@php
			$states = [
				'unclosed' => __('All unclosed'),
				'new' => __('New'),
				'workingon' => __('Working on'),
				'closed' => __('Closed'),
			]
		@endphp
		<select class="form-select" id="fieldState" name="state">
			@foreach ($states as $state => $label)
				<option value="{{$state}}" {{  request('state', 'unclosed') == $state ? 'selected' : '' }}>{{$label}}</option>
			@endforeach
		</select>
	</div>
	<div class="col-auto">
		<label class="d-block" for="fieldMonitor">{{__('Monitor')}}</label>
		<select id="fieldMonitor" class="form-select" name="monitor">
			<option value=""></option>
			@foreach($monitors as $monitor)
				<option value="{{$monitor->id}}" {{request('monitor') == $monitor->id ? 'selected' : ''}}>
					{{$monitor->name}}
				</option>
			@endforeach
		</select>
	</div>
	<div class="col-auto">
		<label class="d-block" for="fieldFrom">{{__('Created from date/time')}}</label>
		<input id="fieldFrom" type="datetime-local" class="form-control d-block mb-1" name="dateFrom" value="{{request('dateFrom')}}">
	</div>
	<div class="col-auto">
		<label class="d-block" for="fieldTo">{{__('Created to date/time')}}</label>
		<input id="fieldTo" type="datetime-local" class="form-control d-block" name="dateTo" value="{{request('dateTo')}}">
	</div>
	<div class="col-auto">
		<div>&nbsp;</div>
		<button type="submit" class="btn w-auto"><span class="fa fa-search"></span></button>
	</div>
</form>