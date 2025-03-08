<span title="{{$state}}" class="incident-state incident-state-{{$state}}">
	@switch($state)
		@case(\AppHealer\Enums\IncidentState::NEW)
			<span class="fa fa-exclamation-triangle"></span>
			@break
		@case(\AppHealer\Enums\IncidentState::CONFIRMED)
			<span class="fa fa-exclamation-circle"></span>
			@break
		@case(\AppHealer\Enums\IncidentState::INVESTIGATING)
			<span class="fa fa-magnifying-glass"></span>
			@break
		@case(\AppHealer\Enums\IncidentState::FIXING)
			<span class="fa fa-code"></span>
			@break
		@case(\AppHealer\Enums\IncidentState::MONITORING)
			<span class="fa fa-binoculars"></span>
			@break
		@case(\AppHealer\Enums\IncidentState::CLOSED)
			<span class="fa fa-check"></span>
			@break
	@endswitch
</span>