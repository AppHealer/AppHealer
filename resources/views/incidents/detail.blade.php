@extends('_layouts.app', ['page' => 'incidents', 'title' => __('Incident') . ' #'. $incident->id])
@section('content')
	<div class="incidentDetail">
		<fieldset class="border border-black mb-4 p-3">
			<legend class="col mb-4 h3 fw-bold">{{$incident->caption}}</legend>
			<div class="row mb-2">
				<div class="col-2">
					{{__('State')}}
				</div>
				<div class="col-4">
					@if (!$incident->isClosed())
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
					@else
						<span class="fw-bold">{{$incident->state}}</span>
					@endif

				</div>
				<div class="col-2">
					{{__('Asignee')}}
				</div>
				<div class="col-4">
					@if (!$incident->isClosed())
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

		@foreach($incident->getHistory() as $item)
			@if ($item instanceof \AppHealer\Models\IncidentComment)
				<fieldset class="border border-black p-2 mb-3">
					<div class="row border-bottom m-0">
						<div class="col-6 fw-bold p-1">
							{{$item->createdBy->name}}
						</div>
						<div class="col-6 text-end p-1">
							{{$item->datetime_created}}
						</div>
					</div>
					<div class="p-2">
							{!! nl2br($item->comment) !!}
					</div>
				</fieldset>
			@elseif ($item instanceof \AppHealer\Models\IncidentHistory)
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
			@endif


		@endforeach


		@if (!$incident->isClosed())
			<form class="form" method="post" id="commentForm" action="{{route('incidents.comments.submit', ['incident' => $incident])}}">
				@csrf
				<fieldset>
					<textarea name="comment" placeholder="{{__('Type comment here')}}" class="{{$errors->hasAny('comment') ? 'is-invalid' : 'border-black'}} form-control p-3 mb-2 ">{{old('comment')}}</textarea>
					@if ($errors->hasAny('comment'))
						<div class="invalid-feedback">{{$errors->first('comment')}}</div>
				@endif
					<div class="w-100 text-end ">
						<input class="btn" type="submit" value="{{__('Add comment')}}">
					</div>
				</fieldset>
			</form>
		@endif
	</div>
@endsection
