<fieldset class="border p-2 mb-3  border-1">
	<div class="row m-0">
		<div class="col-6 border-bottom p-1">
			{{$item->createdBy->name,}}
		</div>
		<div class="col-6 text-end m-0 p-1 border-bottom">
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
					$item->state
				);
				$prevMessage = sprintf(__('was %s'),  $item->prev_state);
			}
		@endphp
		{!!$message!!}
		({{$prevMessage}})
	</div>

</fieldset>