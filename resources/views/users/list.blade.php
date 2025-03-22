@extends('_layouts.app', ['page' => 'users', 'title' => __('Users')])
@section('content')

<a class="btn" href="{{route('users.create')}}">{{__('New user')}}</a>

<div class="row">
	<div class="col-auto">
		<table class="table table-hover">
			<thead>
				<tr>
					<th colspan="2">{{  __('Name') }}</th>
					<th class="d-none d-md-table-cell">{{  __('Email') }}</th>
					<th class="d-none d-md-table-cell">{{  __('Phone') }}</th>
					<th class="d-none d-md-table-cell">{{  __('Last Login') }}</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $user)
					@include('users.components.list.row')
				@endforeach
			</tbody>
		</table>
		{{ $users->links() }}
	</div>
</div>
@endsection