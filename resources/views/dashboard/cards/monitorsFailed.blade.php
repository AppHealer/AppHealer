<div class="card">
	<div class="card-title"><span class="fa fa-exclamation-triangle"></span>{{ __('Most down') }}</div>
	<div class="card-body">
		<div class="timerange mb-2">
			<span class="selected" data-portlet="portletDashboardMonitorFailed" data-portlet-url="{{ route('dashboard.monitors.failed', ['hours' => 1], false) }}">{{__('Last hour')}}</span>
			|
			<span data-portlet="portletDashboardMonitorFailed" data-portlet-url="{{ route('dashboard.monitors.failed', ['hours' => 24], false) }}">{{__('Last day')}}</span>
			|
			<span data-portlet="portletDashboardMonitorFailed" data-portlet-url="{{ route('dashboard.monitors.failed', ['hours' => 168], false) }}">{{__('Last week')}}</span>
		</div>
		<div id="portletDashboardMonitorFailed" data-route="{{ route('dashboard.monitors.failed', ['hours' => 1], false) }}" data-refresh="10">

		</div>
	</div>
</div>