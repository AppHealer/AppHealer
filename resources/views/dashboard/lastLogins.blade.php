<table class="table">
	<thead>
		<tr>
			<th>{{__('Time')}}</th>
			<th>{{__('Location')}}</th>
			<th>{{__('OS & browser')}}</th>
		</tr>
	</thead>
	<tbody>
		@foreach($logins as $login)

			<tr class=" {{ $login->failed ? 'table-danger'  : '' }}">
				<td class="text-end" title="{{$login->eventtime}}">{{ $login->eventtime->diffForHumans(now(), \Carbon\CarbonInterface::DIFF_ABSOLUTE, true  ) }} {{__('ago')}}</td>
				<td>{{ $login->ip_address }}</td>
				<td>{{ $login->system }} {{ $login->browser }}</td>
			</tr>
		@endforeach
	</tbody>
</table>