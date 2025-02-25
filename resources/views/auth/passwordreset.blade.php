@extends('_layouts.app')
@section('content')
	<form class="form-login rounded" method="post">
		@csrf
		@if($errors->any())
			<div class="mb-2 errors">
				{{$errors->first() }}
			</div>
		@endif
		<div class="mb-2">
			<h3>{{__('Password reset')}}</h3>
		</div>
		@if(session('message'))
			<div class="mb-2">
				{{session('message') }}
			</div>
		@endif
		<div class="mb-2 mt-2">
			<div class="input-group">
				<div class="input-group">
					<span class="input-group-addon"><span class="fa fa-at"></span></span>
					<input type="email" class="form-control" autocomplete="off" placeholder="{{__('Email')}}" name="email"/>
				</div>
			</div>
		</div>
		<div class="mb-2 mt-2">
			<div class="input-group">
				<div class="input-group">
					<span class="input-group-addon"><span class="fa fa-key"></span></span>
					<input type="password" class="form-control" autocomplete="false" placeholder="{{__('Password')}}" name="password"/>
				</div>
			</div>
		</div>

		<div class="mb-4 mt-2">
			<div class="input-group">
				<div class="input-group">
					<span class="input-group-addon"><span class="fa fa-check"></span></span>
					<input type="password" class="form-control" autocomplete="false" placeholder="{{__('Retry password')}}" name="password_confirmation"/>
				</div>
			</div>
		</div>
		<div class="buttons">
			<input type="hidden" name="resettoken" value="{{$resettoken}}"/>
			<input type="submit" class="btn btn-primary" value="{{__('Save password')}}"/>
		</div>
	</form>
@endsection