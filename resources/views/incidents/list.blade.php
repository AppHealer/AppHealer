@extends('_layouts.app', ['page' => 'incidents', 'title' => 'Incidents'])
@section('content')
	<a href="{{route('incidents.create')}}" class="btn">{{__('New incident')}}</a>
	<table class="table">
		<thead>
			<th colspan="2">{{__('Incident caption')}}</th>
			<th>{{__('Monitor')}}</th>
			<th>{{('Started')}}</th>
			<th>{{('Assigned to')}}</th>
			<th>{{('Closed')}}</th>
			<th>{{('Author')}}</th>
		</thead>
		<tbody>
			@foreach($incidents as $incident)
				<tr>
					<td>
						<a class="link" href="{{route('incidents.detail', ['incident' => $incident])}}">#{{$incident->id}}</a>
					</td>
					<td>
						<a class="link" href="{{route('incidents.detail', ['incident' => $incident])}}">{{$incident->caption}}</a>
					</td>
					<td>{{$incident->monitor->name}}</td>
					<td>{{$incident->datetime_created}}</td>
					<td>{{$incident->assignedTo?->name}}</td>
					<td>{{$incident->datetime_closed}}</td>
					<td>{{$incident->createdBy ? $incident->createdBy->name : 'AppHealer'}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection