@extends(
	'_layouts.app',
	[
		'page' => 'monitors',
		'title' => isset($monitor) ?  __('Edit monitor :name', ['name' => $monitor->name]) : __('New monitor')
	]
)
@section('content')
	<form class="form" method="post">
		@csrf
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

		<fieldset class="border p-3 mb-3">
			<legend>{{__('Request settings')}}</legend>
			<div class="row mb-2">
				<div class="col-md-4 col-sm-12">
					<label class="col-form-label" for="fieldEndpoint">{{ __('Endpoint') }}</label>
				</div>
				<div class="col-md-8 col-sm-12">
					<input type="text" name="endpoint" id="fieldEndpoint" class="form-control {{ $errors->has('endpoint') ? 'is-invalid': '' }}" value="{{old('endpoint') ?? (isset($monitor) ? $monitor->endpoint : '')}}">
					@if ($errors->hasAny('endpoint'))
						<div class="invalid-feedback">
							{{  $errors->first('endpoint') }}
						</div>
					@endif
				</div>
			</div>

			<div class="row">
				<div class="col-7 mb-2 row" >
					<div class="col-md-6 col-sm-12">
						<label class="col-form-label" for="fieldInterval">{{ __('Check every') }}</label>
					</div>
					<div class="col-md-6 col-sm-12">
						<select class="form-select" name="interval" id="fieldInterval">
							@php
								$vals = [
									'0' => __('never'),
									'10' => '10s',
									'15' => '15s',
									'30' => '30s',
									'60' => '1m',
									'120' => '2m',
									'300' => '5m',
									'600' => '10m',
									'900' => '15m',
									'1200' => '20m',
									'1800' => '30m',
									'3600' => '60m',
								];
							@endphp
							@foreach ($vals as $key => $val)
								<option value="{{$key}}" {{ $key == (old('interval') ?? (isset($monitor) ? $monitor->interval : '')) ? 'selected="selected"' : ''}}>{{$val}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-6 row">
					<div class="col-md-6 col-sm-12">
						<label class="col-form-label" for="fieldTimeout">{{ __('Timeout s') }}</label>
					</div>
					<div class="col-md-6 col-sm-12">
						<input class="form-control" id="fieldTimeout" name="timeout" type="number" min="1" max="60" value="{{old('timeout') ?? (isset($monitor) ? $monitor->timeout : 10)}}"/>
					</div>
				</div>
			</div>
		</fieldset>
		<a href="{{isset($monitor) ? route('monitors.detail', ['monitor' => $monitor]) : route('monitors')}}" class="btn btnCancel">{{__('Back')}}</a>
		<input type="submit" class="btn" value="{{__('Save')}}"/>
	</form>
@endsection