<div class="dropdown">
	<span  id="dropdownState" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<span class="fw-bold">{{$incident->state }}</span>
		<i class="fa fa-arrow-right-rotate"></i>
	</span>
	<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		@foreach(\AppHealer\Enums\IncidentState::cases() as $state)
			<a class="dropdown-item" href="{{route('incidents.change-state', ['incident' => $incident, 'state' => $state])}}">
				{{$state->value}}
			</a>
		@endforeach
	</div>
</div>