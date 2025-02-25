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
			<div class="col-2">{{__('Name')}}</div>
			<div class="col-5">{{$profile->name}}</div>
		</div>
		<div class="row mb-2">
			<div class="col-2">{{__('Email')}}</div>
			<div class="col-5">{{$profile->email}}</div>
		</div>
		<div class="row mb-2">
			<div class="col-2">{{__('Phone')}}</div>
			<div class="col-5">{{$profile->phone}}</div>
		</div>
	</fieldset>
@endsection