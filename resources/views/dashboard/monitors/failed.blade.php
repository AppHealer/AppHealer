<table class="table">
	<tbody>
	@foreach($monitors as $monitor)
		<tr>
			<td style="width:180px">
				<a href="{{route('monitors.detail', ['monitor' => $monitor])}}">{{$monitor->name}}</a>
			</td>
			<td class="graph align-middle" title="Uptime {{round($monitor->checks_ok * 100 /$monitor->checks_total)}}%">
				<div class="full">
					<div class="ok" style="width:{{round($monitor->checks_ok * 100 /$monitor->checks_total)}}%">

					</div>
				</div>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>