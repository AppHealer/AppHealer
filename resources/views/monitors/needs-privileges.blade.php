@extends(
	'_layouts.app',
	[
		'page' => 'monitors',
		'title' => __(':name : Privileges required', ['name' => $monitor->name])
	]
)
@section('content')
	<div class="alert-danger alert">
		{{__('You need more privileges to finish this action.')}}
	</div>
@endsection