@extends(
	'_layouts.app',
	 [
		'page' => 'profile',
		'title' =>  __('My profile')
	]
)
@section('content')
	<div class="row w-100 mb-2">
		<div class="col">
			<a href="{{route('profile.edit')}}" class="btn">Edit</a>
		</div>
	</div>
	<fieldset class="border mb-3 p-3">
		<div class="row mb-2">
			<div class="col-3">{{__('Name')}}</div>
			<div class="col-auto fw-bold">{{$profile->name}}</div>
		</div>
		<div class="row mb-2">
			<div class="col-3">{{__('Email')}}</div>
			<div class="col-auto fw-bold">{{$profile->email}}</div>
		</div>
		<div class="row mb-2">
			<div class="col-3">{{__('Phone')}}</div>
			<div class="col-auto fw-bold">{{$profile->phone}}</div>
		</div>
	</fieldset>
@endsection