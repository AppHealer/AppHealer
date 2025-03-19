@extends('_layouts.app', ['title' => __('Forbidden')])
@section('content')
	<div class="alert alert-danger">
		{{__('Your request needs admin privileges.')}}
	</div>
@endsection