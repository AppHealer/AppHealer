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
	<header>
		<div class="row">
			<div class="col-8 col-lg-6">
				@if (auth()->user())
					<a  href="{{route('dashboard')}}">
						<img src="/images/logo.png" alt="logo" class="logo"/>
					</a>
				@else
					<img src="/images/logo.png" alt="logo" class="logo"/>
				@endif
			</div>
			<div class="col"></div>
			<div class="col-auto">
				@if (auth()->user())
					<span id="menu-toggler" class="menu-toggler fa fa-bars d-md-none"></span>
					@include("_components.menu.currentUser")
				@endif
			</div>
		</div>
		<div class="d-block d-md-none">
			@include("_components.menu.currentUser-mobile")
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
