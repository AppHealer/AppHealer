@extends('_layouts.app', ['page' => 'incidents', 'title' => 'Incidents'])
@section('content')
	<a href="{{route('incidents.create')}}" class="btn">{{__('New incident')}}</a>
	<table class="table incidents mt-3 w-auto">
		<thead>
			<tr>
				<th class="colState"></th>
				<th class="colName">{{__('Name')}}</th>
				<th class="d-none d-md-table-cell">{{__('Monitor')}}</th>
				<th class="colStarted text-end">{{('Started')}}</th>
				<th class="d-none d-md-table-cell colAssigned">{{('Assigned to')}}</th>

			</tr>
		</thead>
		<tbody>
			@foreach($incidents as $incident)
				<tr>
					<td class="align-middle colState">@include('incidents.components.state', ['state' => $incident->state])</td>

					<td class="colName align-middle  d-none d-md-table-cell ">
						<div class="row">
							<div class="col-2">
								<a class="link" href="{{route('incidents.detail', ['incident' => $incident])}}">#{{$incident->id}}</a>
							</div>
							<div class="col">
								<a class="link" href="{{route('incidents.detail', ['incident' => $incident])}}">{{$incident->caption}}</a>
							</div>
						</div>
					</td>
					<td class="colName align-middle d-table-cell d-md-none">
						<div class="row">
							<div class="col-2">
								<a class="link" href="{{route('incidents.detail', ['incident' => $incident])}}">#{{$incident->id}}</a>
							</div>
							<div class="col">
								<div class="onMobile">
									<a class="link" href="{{route('incidents.detail', ['incident' => $incident])}}">{{$incident->caption}}</a>
								</div>
								<div class="onMobile">
									{{$incident->monitor->name}}
								</div>
							</div>
						</div>
					</td>
					<td class="align-middle d-none d-md-table-cell colMonitor">{{$incident->monitor->name}}</td>
					<td class="align-middle text-end colStarted">
						{{
							sprintf(
								__('%s ago'),
								$incident->datetime_created->shortAbsoluteDiffForHumans(now(), 4)
							)
						}}
					</td>
					<td class="align-middle d-none d-md-table-cell colAssigned">{{$incident->assignedTo?->name}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection