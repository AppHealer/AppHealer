@extends('_layouts.mail')
@section('content')
	<div style="font-weight:bold;margin-bottom:15px">
		{{__('We receive sending password reset request.')}}
	</div>
	<div style="padding-bottom:10px">
		{{__('To set a new password, click on following link or copy it and open in a browser:')}} <br/>
	</div>
	<a style="font-weight:bold;color:#4a5568" href="{{route('passwordreset.reset', ['resettoken' => $resettoken])}}">
		{{route('passwordreset.reset', ['resettoken' => $resettoken])}}
	</a>
@endsection