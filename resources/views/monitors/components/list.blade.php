<table class="table monitors w-auto">
	<thead class="table-light">
	<tr>
		<th class="align-middle" colspan="2">{{__('Name')}}</th>
		<th class="align-middle">{{__('Timeout')}}</th>
		<th>&nbsp;</th>
		<th>{{__('Uptime')}} <br> {{__('24 H')}}</th>
		<th>&nbsp;</th>
		<th class="align-middle text-end">{{__('Last check')}}</th>
	</tr>

	</thead>
	<tbody>
	@foreach($monitors as $monitor)
		<tr class="
			@if ($monitor->lastcheck)
				{{ $monitor->lastcheck?->failed ? 'failed' : 'ok' }}
			@else
				nochecked
			@endif

		">
			<td class="colStatus"><span class="status"></span></td>
			<td class="colName">
				<div class="name">
					<a href="{{route('monitors.detail', ['monitor' => $monitor])}}">{{$monitor->name}}</a>
				</div>

				@if ($monitor->lastcheck && $monitor->lastcheck->failed == true)
					<div class="up">down {{$monitor->down->diffForHumans(now(), \Carbon\CarbonInterface::DIFF_ABSOLUTE, true, 2  ) }}</div>
				@elseif ($monitor->lastcheck && $monitor->lastcheck->failed == false)
					<div class="up">up {{$monitor->up->diffForHumans(now(), \Carbon\CarbonInterface::DIFF_ABSOLUTE, true, 2  ) }}</div>
				@else
					<div class="never">
						{{__('never checked')}}
					</div>
				@endif
			</td>
			<td class="colTimeout text-end align-middle timeout">
				@if ($monitor->lastcheck)
					{{$monitor->lastcheck?->timeout}} ms
				@endif
			</td>
			<td class="colTimeoutGraph align-middle">
				@if ($monitor->lastcheck)
					<img class="timeoutGraph" src="{{route('monitors.list.timeout.graph', ['monitor' => $monitor])}}?{{$monitor->lastcheck?->id}}" />
				@endif
			</td>
			<td class="colUptime text-end align-middle">
				@if ($monitor->checks_all !== null)
					{{ number_format($monitor->checks_ok * 100 / $monitor->checks_all, 1) }} %
				@endif
			</td>
			<td class="colChecks align-middle">
				@foreach($monitor->lastChecks(15) as $check)
					<div class="check {{$check->failed == 1 ? 'checkFailed' : ''}}" title="{{$check->eventtime}}  &#013;Timeout: {{$check->timeout}} ms &#013;Status code: {{$check->statuscode}}">
					</div>
				@endforeach

			</td>
			<td class="colLastCheck text-end align-middle">
				@if ($monitor->lastcheck)
					{{$monitor->lastcheck?->eventtime->diffForHumans(now(), \Carbon\CarbonInterface::DIFF_ABSOLUTE, true  ) }} ago
				@endif
			</td>


		</tr>
	@endforeach
	</tbody>
</table>