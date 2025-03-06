@extends('_layouts.app')
@section('content')
	<form method="post" class="form-login rounded">

		<div class="mb-4 mt-1">
			<h3>{{ __('Login') }}</h3>
		</div>

		@if($errors->any())
			<div class="mb-2 errors">
				{{$errors->first() }}
			</div>
		@endif
		@if(session('message'))
			<div class="mb-2">
				{{session('message') }}
			</div>
		@endif
		@csrf
		<div class="mb-2 mt-2">
			<div class="input-group">
				<div class="input-group">
					<span class="input-group-addon"><span class="fa fa-at"></span></span>
					<input type="email" class="form-control" placeholder="email" name="email"/>
				</div>

			</div>
		</div>
		<div class="mb-4">
			<div class="input-group">
				<div class="input-group show-password">
					<span class="input-group-addon"><span class="fa fa-key"></span></span>
					<input name="password" type="password" placeholder="password" class="form-control">
					<span class="wrapper input-group-addon rounded-end-2 "><span class="fa fa-eye"></span></span>
				</div>
			</div>
		</div>
		<div class="buttons">
			<input type="submit" class="btn btn-primary" value="Login"/>
		</div>
		<div class="lostpassword" >
			<a href="{{ route('passwordreset') }}">Lost password</a>
		</div>
	</form>
@endsection