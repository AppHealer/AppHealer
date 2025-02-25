@extends('_layouts.app')
@section('content')
	<form class="form-login rounded" method="post">
		@csrf
		<div class="mb-2">
			<h3>{{__('Lost password')}}</h3>
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
		<div class="mb-4 mt-2">
			<div class="input-group">
				<div class="input-group">
					<span class="input-group-addon"><span class="fa fa-at"></span></span>
					<input type="email" class="form-control" autocomplete="false" placeholder="email" name="email"/>
				</div>

			</div>
		</div>
		<div class="buttons">
			<input type="submit" class="btn btn-primary" value="{{__('Send reset link')}}"/>
		</div>
	</form>
@endsection