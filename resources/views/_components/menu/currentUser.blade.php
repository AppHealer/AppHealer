<nav class="currentUser mt-3">
	<div class="name dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
		<img class="photo" src="/images/user.jpg" />
		<span>{{auth()->user()->name}}</span>
	</div>
	<ul class="dropdown-menu">
		<li>
			<a class="dropdown-item pe-4" href="{{route('profile.view')}}">
				<span class="fa fa-user me-1"></span>
				{{__('Profile')}}
			</a>
		</li>
		<li>
			<a class="dropdown-item pe-4" href="{{route('profile.changePassword')}}">
				<span class="fa fa-key me-1"></span>
				{{__('Change password')}}
			</a>
		</li>
		<li>
			<a class="dropdown-item pe-4" href="{{route('profile.loginHistory')}}">
				<span class="fa fa-list-check me-1"></span>
				{{__('Login history')}}
			</a>
		</li>
		<li><hr class="dropdown-divider"></li>
		<li>
			<a class="dropdown-item pe-4" href="{{route('auth.logout')}}">
				<span class="fa fa-door-closed me-1"></span>
				{{__('Logout')}}
			</a>
		</li>
	</ul>
</nav>
