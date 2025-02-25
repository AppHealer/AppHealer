<div class="card">
	<div class="card-title"><span class="fa fa-hourglass-3"></span>{{ __('Slowest responses') }}</div>
	<div class="card-body">
		<div class="timerange mb-2">
			<span class="selected" data-portlet="portletDashboardMonitorSlow" data-portlet-url="{{ route('dashboard.monitors.slow', ['hours' => 1], false) }}">{{__('Last hour')}}</span>
			|
			<span data-portlet="portletDashboardMonitorSlow" data-portlet-url="{{ route('dashboard.monitors.slow', ['hours' => 24], false) }}">{{__('Last day')}}</span>
			|
			<span data-portlet="portletDashboardMonitorSlow" data-portlet-url="{{ route('dashboard.monitors.slow', ['hours' => 168], false) }}">{{__('Last week')}}</span>
		</div>
		<div id="portletDashboardMonitorSlow" data-route="{{ route('dashboard.monitors.slow', ['hours' => 1], false) }}" data-refresh="10">

		</div>
	</div>
</div>