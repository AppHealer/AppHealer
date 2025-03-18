@extends(
	'_layouts.app',
	[
		'page' => 'monitors',
		'title' => __(':name : Manage team', ['name' => $monitor->name])
	]
)
@section('content')
<div class="mb-4">
	<a class="btn" href="{{route('monitors.detail', ['monitor' => $monitor])}}">{{__('Back')}}</a>
	<a class="btn" href="{{route('monitors.team.add', ['monitor' => $monitor])}}">{{__('Add member')}}</a>
</div>
<table class="table table-team">
	<tbody>
	@foreach ($monitor->team as $user)
		<tr>
			<td class="col-name">{{$user->name}}</td>
			<td class="col-role">
				<span data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span>{{$user->pivot->role}}</span>
					<i class="fa fa-user-pen"></i>
				</span>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					@foreach($roles as $role)
						<a class="dropdown-item"
							href="{{route('monitors.team.assign', ['user' => $user, 'monitor' => $monitor, 'role' => $role])}}"
						>
							{{$role}}
						</a>
					@endforeach
				</div>
			</td>
			<td class="actions">
				<a
					href="{{route('monitors.team.remove', ['monitor' => $monitor, 'user' => $user])}}"
					class="fa fa-trash"
					data-modal-text="{{ __('Really remove :name from the team?', ['name' => $user->name]) }}"
					data-confirm-text="{{__('Remove')}}"
					data-bs-target="#confirmationModal"
					data-bs-toggle="modal"
				></a>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
@endsection