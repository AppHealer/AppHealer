@extends(
	'_layouts.app',
	 [
		'page' => 'users',
		'title' => isset($user) ?  __('Edit user :name', ['name' => $user->name]) : __('New user')
	]
)
@section('content')
	<form method="post" action="{{isset($user)? route('users.edit.save', ['user' => $user->id ]) : route('users.edit.save.new')}}">
		@csrf

		@include('users.components.edit.userdata')
		@include('users.components.edit.privileges')

		<a class="btn btnBack" href="{{route('users')}}">{{__('Back')}}</a>
		<input type="hidden" name="page" value="{{$pagingPage}}">
		<input type="submit" class="btn btn-primary" value="{{ __('Save user')  }}">
	</form>
@endsection