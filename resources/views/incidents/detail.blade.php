@extends(
	'_layouts.app',
	 [
		'page' => 'incidents',
		'title' => $incident->caption
		]
	)
@section('content')
	<div class="incidentDetail">
		@include('incidents.components.detail.header')

		@foreach($incident->getHistory() as $item)
			@if ($item instanceof \AppHealer\Models\IncidentComment)
				@include('incidents.components.detail.historyComment')
			@elseif ($item instanceof \AppHealer\Models\IncidentHistory)
				@include('incidents.components.detail.historyChange')
			@endif
		@endforeach

		@if (!$incident->isClosed())
			@include('incidents.components.detail.commentForm')
		@endif
	</div>
@endsection
