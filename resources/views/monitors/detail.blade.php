@extends(
	'_layouts.app',
	[
		'page' => 'monitors',
		'title' => $monitor->name
	]
)

@section('content')
	<div class="mb-4">
		@include('monitors.components.detail.buttons')
	</div>

	@include('monitors.components.detail.datetimeFilter')

	@if ($summary->getTotal() !== 0)
		<div class="row mb-2 p-3 summary">
			@include('monitors.components.detail.availability')
			@include('monitors.components.detail.timeout')
		</div>
		<div class="row">
			<div class="col-sm-3 col-md-auto p-3">
				<h3 class="text-center">{{__('Availability')}}</h3>
				@include("monitors.svg.availability")
			</div>
			<div class="col-sm-6 col-md-auto p-3">
				<h3 class="text-center">{{__('Average timeout (in ms)')}}</h3>
				@include("monitors.svg.timeout")
			</div>
		</div>
	@else
		<div class="row m-2 mt-4">
			<div class="col-auto alert alert-warning p-3">
				{{__('There are no data for selected time range.')}}
			</div>
		</div>
	@endif
@endsection