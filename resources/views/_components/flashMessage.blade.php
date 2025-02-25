@if (session('message'))
	<div class="alert alert-success">
		{!! session('message') !!}
	</div>
@endif

@if (session('error'))
	<div class="alert alert-danger">
		{!! session('error') !!}
	</div>
@endif
