<!doctype html>

<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1, user-scalable=no">
	<title>{{ isset($title) ? $title . ' | '  : '' }}AppHealer</title>
	<link rel="icon" type="image/x-icon" href="/images/favicon.png">
	@vite(
		[
			'resources/css/app.scss'
		]
	)
</head>

<body>
	<header class="row">
		<div class="col">
			@if (auth()->user())
				<a href="{{route('dashboard')}}">
					<img src="/images/logo.png" alt="logo" class="logo"/>
				</a>
			@else
				<img src="/images/logo.png" alt="logo" class="logo"/>
			@endif
		</div>
		<div class="col-auto">
			@if (auth()->user())
				@include("_components.menu.currentUser")
			@endif
		</div>
	</header>
	@if (auth()->user())
		@include("_components.menu.main")
		<div class="content" id="app">
			@include('_components.title')
			@include('_components.flashMessage')
			@yield('content')
		</div>
	@else
		<div>
			@yield('content')
		</div>
	@endif
	@include('_components.dialogs.confirmationDialog')
	<script>var exports = {};</script>
	@vite(
		[
			'resources/js/app.js',
		]
	)
</body>
</html>
