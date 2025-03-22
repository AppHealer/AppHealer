@extends('_layouts.app', ['title' => 'Installation'])
@section('content')
	<div class="content installation">
		<h2>
			{{__('AppHealer is almost installed. ')}}
		</h2>

		<form class="form" method="post" action="{{route('installation.save.env')}}">
			@csrf
			<fieldset class="alert alert-info mt-4">
				{{__('We just need to configure AppHealer basic options and mail settings for mail notification and create first user.')}}
			</fieldset>

			@include('installation.components.env.basic')
			@include('installation.components.env.mail')
			<fieldset class="text-end p-3">
				<input type="submit" class="form-control btn" value="{{__('Save')}}"/>
			</fieldset>
		</form>
	</div>
@endsection