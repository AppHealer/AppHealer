<table class="table">
	<thead>
		<tr>
			<th></th>
			<th class="text-center">{{__('Avg')}}</th>
			<th class="text-center">{{__('Min')}}</th>
			<th class="text-center">{{__('Max')}}</th>
		</tr>
	</thead>
	<tbody>
		@foreach($monitors as $monitor)
			<tr>
				<td>
					<a href="{{route('monitors.detail', ['monitor' => $monitor])}}">{{$monitor->name}}</a>
				</td>
				<td style="width: 85px;" class="text-end align-middle">{{number_format($monitor->timeout_avg, 0, '.', ' ')}} ms</td>
				<td style="width: 85px;" class="text-end align-middle">{{number_format($monitor->timeout_min, 0, '.', ' ')}} ms</td>
				<td style="width: 85px;" class="text-end align-middle">{{number_format($monitor->timeout_max, 0, '.', ' ')}} ms</td>
			</tr>
		@endforeach
	</tbody>
</table>