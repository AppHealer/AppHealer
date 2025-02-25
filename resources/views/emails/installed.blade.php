@extends('_layouts.mail')
@section('content')
	<div style="font-weight:bold;margin-bottom:15px;">
		{{__('AppHealer has been successfully installed.')}}
	</div>
	<div>
		{{__('AppHealer is accessible on this url:')}}
		<a style="font-weight:bold;color:#4a5568" href="{{config('app.url') }}">
			{{config('app.url') }}
		</a>
	</div>

@endsection