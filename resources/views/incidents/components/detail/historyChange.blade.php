<fieldset class="border p-2 mb-3  border-1">
	<div class="row m-0">
		<div class="col-6 border-bottom p-1 pt-0 m-0">
			{{$item->createdBy ? $item->createdBy->name : 'AppHealer'}}
		</div>
		<div class="col-6 text-end m-0 p-1 pt-0 border-bottom">
			{{$item->datetime_created}}
		</div>
	</div>

	<div class="p-2">
		@php
			if ($item->assignedUser !== null) {
				$message = sprintf(
					__('<span class="fst-italic">incident assigned to</span> <span class="fw-bold">%s</span>'),
					$item->assignedUser->name
				);
				if($item->prevAssignedUser !== null) {
					$prevMessage = sprintf(__('was %s'),  $item->prevAssignedUser->name);
				}
			} else {
				$message = sprintf(
					__('<span class="fst-italic">status set to </span> <span class="fw-bold">%s</span>'),
					$item->state->value
				);
				$prevMessage = sprintf(__('was %s'),  $item->prev_state->value);
			}
		@endphp
		<div class="row pb-0 mb-0">
			@if($item->state !== null)
				<div class="col-auto">
					@include('incidents.components.state', ['state' => $item->state])

				</div>
			@endif
			<div class="col mt-1">
				{!!$message!!}
				@if (isset($prevMessage))
					({{$prevMessage}})
				@endif
			</div>
		</div>
	</div>

</fieldset>