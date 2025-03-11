@extends('_layouts.mail')
@section('content')
	<div style="font-weight:bold;margin-bottom:15px;">
		{!!
			sprintf(
				__('Automatic incident [%s] for %s closed'),
				sprintf(
					'<a href="%s">#%s</a>',
					route('incidents.detail', ['incident' => $incident]),
					$incident->id
				),
				sprintf(
					'<a href="%s">#%s</a>',
					route('monitors.detail', ['monitor' => $incident->monitor]),
					$incident->monitor->name
				)
			)
		 !!}
	</div>
	<div style="margin-bottom:15px;">
		{{$incident->comments()->latest()->first()->comment}}
	</div>
	<div>
	</div>


@endsection