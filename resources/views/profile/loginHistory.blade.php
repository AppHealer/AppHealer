@extends(
	'_layouts.app',
	 [
		'page' => 'profile',
		'title' =>  __('Login history')
	]
)
@section('content')
	<table class="table w-25">
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
					<td>{{ $login->eventtime->diffForHumans(now(), \Carbon\CarbonInterface::DIFF_ABSOLUTE, true  ) }}</td>
					<td>{{ $login->ip_address }}</td>
					<td>{{ $login->system }} {{ $login->browser }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	{{ $logins->links() }}
@endsection