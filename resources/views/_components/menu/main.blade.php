<nav class="main">
	<ul class="nav nav-tabs">
		<li class="nav-item">
			<a class="nav-link {{ isset($page) && $page == 'dashboard' ? 'active' : '' }}" href="{{ route('dashboard') }}">
				<span class="fa-solid fa-chart-area"></span>
				<span class="d-none d-md-inline">{{ __('Dashboard') }}</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link {{ isset($page) && $page == 'monitors' ? 'active' : '' }}" href="{{ route('monitors') }}">
				<span class="fa-solid fa-heart-circle-check"></span>
				<span class="d-none d-md-inline">{{ __('Monitors') }}</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link {{ isset($page) && $page == 'users' ? 'active' : '' }}" href="{{ route('users') }}">
				<span class="fa-solid fa-user-group"></span>
				<span class="d-none d-md-inline">{{ __('Users') }}</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link {{ isset($page) && $page == 'incidents' ? 'active' : '' }}" href="{{ route('incidents') }}">
				<span class="fa-solid fa-exclamation-triangle"></span>
				<span class="d-none d-md-inline">{{ __('Incidents') }}</span>
			</a>
		</li>
	</ul>
</nav>