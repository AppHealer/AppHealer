@extends('_layouts.app', ['title' => __('Unknown Request')])
@section('content')
	<div class="alert alert-danger">
		{{__('Your request cannot be handled. If you get this url from external source, it is misspelled.')}}
	</div>
@endsection