<nav class="currentUser rounded-2 d-none" id="menu-currentUser">
	<ul class="p-2 mt-3">
		<li class="caption">
			<img class="photo" src="/images/user.jpg" />
			<span>{{auth()->user()->name}}</span>

		</li>
		<li class="p-1">
			<a class="pe-4" href="{{route('profile.view')}}">
				<span class="fa fa-user me-1"></span>
				{{__('Profile')}}
			</a>
		</li>
		<li class="p-1">
			<a class="pe-4" href="{{route('profile.changePassword')}}">
				<span class="fa fa-key me-1"></span>
				{{__('Change password')}}
			</a>
		</li>
		<li class="p-1">
			<a class="pe-4" href="{{route('profile.loginHistory')}}">
				<span class="fa fa-list-check me-1"></span>
				{{__('Login history')}}
			</a>
		</li>
		<li class="p-1">
			<a class="pe-4" href="{{route('auth.logout')}}">
				<span class="fa fa-door-closed me-1"></span>
				{{__('Logout')}}
			</a>
		</li>
	</ul>
</nav>