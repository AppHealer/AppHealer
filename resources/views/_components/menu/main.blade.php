<nav class="main">
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link {{ isset($page) && $page == 'dashboard' ? 'active' : '' }}" href="{{ route('dashboard') }}">
				<span class="fa-solid fa-chart-area"></span>
				{{ __('Dashboard') }}
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link {{ isset($page) && $page == 'monitors' ? 'active' : '' }}" href="{{ route('monitors') }}">
				<span class="fa-solid fa-heart-circle-check"></span>
				{{ __('Monitors') }}
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link {{ isset($page) && $page == 'users' ? 'active' : '' }}" href="{{ route('users') }}">
				<span class="fa-solid fa-user-group"></span>
				{{ __('Users') }}
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link {{ isset($page) && $page == 'incidents' ? 'active' : '' }}" href="{{ route('incidents') }}">
				<span class="fa-solid fa-exclamation-triangle"></span>
				{{ __('Incidents') }}
			</a>
		</li>
	</ul>
</nav>