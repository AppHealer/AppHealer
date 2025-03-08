<div class="dropdown">
	<span  id="dropdownAsignee" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<span class="fw-bold">{{$incident->assignedTo ? $incident->assignedTo->name : 'unassigned'}}</span>
		<i class="fa fa-user-pen"></i>
	</span>
	<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		@foreach($users as $user)
			<a class="dropdown-item" href="{{route('incidents.assign', ['user' => $user, 'incident' => $incident])}}">
				{{$user->name}}
			</a>
		@endforeach
	</div>
</div>