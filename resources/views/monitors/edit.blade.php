@extends(
	'_layouts.app',
	[
		'page' => 'monitors',
		'title' => isset($monitor) ?  __(':name : Edit', ['name' => $monitor->name]) : __('New monitor')
	]
)
@section('content')
	<form class="form" method="post">
		@csrf
		@include('monitors.components.edit.basic')
		@include('monitors.components.edit.request')
		@include('monitors.components.edit.httpauth')
		@include('monitors.components.edit.incidents')

		<a href="{{isset($monitor) ? route('monitors.detail', ['monitor' => $monitor]) : route('monitors')}}" class="btn btnCancel">{{__('Back')}}</a>
		<input type="submit" class="btn" value="{{__('Save')}}"/>
	</form>
@endsection