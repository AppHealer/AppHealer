<fieldset class="border border-black mb-4 p-3">
	<legend class="mb-4 h3 fw-bold row">{{$incident->caption}}</legend>
	<div class="row mb-2">
		<div class="col-2">
			{{__('State')}}
		</div>
		<div class="col-4">
			@if (!$incident->isClosed())
				@include('incidents.components.detail.header.stateDropdown')
			@else
				<span class="fw-bold">{{$incident->state}}</span>
			@endif

		</div>
		<div class="col-2">
			{{__('Asignee')}}
		</div>
		<div class="col-4">
			@if (!$incident->isClosed())
				@include('incidents.components.detail.header.asigneeDropdown')
			@else
				<span class="fw-bold">{{$incident->assignedTo ? $incident->assignedTo->name : 'unassigned'}}</span>
			@endif

		</div>
	</div>
	<div class="row mb-2">
		<div class="col-2">
			{{__('Started')}}
		</div>
		<div class="col-4 fw-bold">
			{{$incident->datetime_created}}
		</div>
		<div class="col-2">
			{{__('Author')}}
		</div>
		<div class="col-4">
			<span class="fw-bold">{{$incident->createdBy ? $incident->createdBy->name : 'AppHealer'}}</span>
		</div>
	</div>
	@if ($incident->isClosed())
		<div class="row mb-2">
			<div class="col-2">
				{{__('Closed')}}
			</div>
			<div class="col-4 fw-bold">
				{{$incident->datetime_closed}}
			</div>
			<div class="col-2">
				{{__('Closed by')}}
			</div>
			<div class="col-4">
				<span class="fw-bold">{{$incident->closedBy ? $incident->closedBy->name : 'AppHealer'}}</span>
			</div>
		</div>
		<div class="row">
			<div class="col-2">{{__('Duration')}}</div>
			<div class="col fw-bold">
				{{
					$incident->datetime_created->diffForHumans(
						$incident->datetime_closed,
						[
							'join' => ', ',
							'parts' => 3,
							'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE,
						]
					)
				}}
			</div>
		</div>
	@endif
</fieldset>