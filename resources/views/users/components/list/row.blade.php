<tr>
	<td>
		<span style="visibility: {{$user->blocked == false ? 'hidden' : 'visible'}}" class="fa fa-cancel"></span>
	</td>
	<td>{{ $user->name }}</td>
	<td class="d-none d-md-table-cell">{{ $user->email }}</td>
	<td class="d-none d-md-table-cell">{{ $user->phone }}</td>
	<td class="d-none d-md-table-cell">{{ $user->lastLogin ?? '' }}</td>
	<td class="actions text-end">
		<a href="{{ route('users.block', ['user' => $user->id]) }}?page={{request()->get('page', 0)}}"
		   class="fa {{ $user->blocked ? 'fa-lock-open ' : 'fa-lock' }}"
		   {{ auth()->user()->id == $user->id ? 'style=visibility:hidden;' : ''}}
		   data-modal-text="{{ __('Really ' . ($user->blocked ? 'un' : '') . 'lock user :name?', ['name' => $user->name]) }}"
		   data-confirm-text="{{ $user->blocked ? __('Unblock') : __('Block')}}"
		   data-bs-target="#confirmationModal"
		   data-bs-toggle="modal"
		></a>
		<a href="{{ route('users.edit', ['user' => $user->id]) }}" class="fa fa-pencil"></a>
		<a
				href="{{ route('users.delete', ['user' => $user->id]) }}?page={{request()->get('page', 0)}}"
				class="fa fa-trash"
				{{ auth()->user()->id == $user->id ? 'style=visibility:hidden;' : ''}}
				data-bs-toggle="modal"
				data-bs-target="#confirmationModal"
				data-confirm-text="{{__('Delete')}}"
				data-modal-text="{{ __('Really delete user :name?', ['name' => $user->name]) }}"
		></a>
	</td>
</tr>