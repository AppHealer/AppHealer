@extends('_layouts.app', ['page' => 'incidents', 'title' => 'New incident'])
@section('content')
	<form class="form" method="post" action="{{route('incidents.create.submit')}}">
		@csrf
		<fieldset class="border p-3 mb-3">
			<div class="row mb-2">
				<div class="col-md-4 col-sm-12">
					<label class="col-form-label" for="fieldMonitor">{{__('Monitor')}}</label>
				</div>
				<div class="col-md-6 col-sm-12">
					<select name="monitor_id" id="fieldMonitor" class="form-select {{$errors->hasAny('monitor_id') ? 'is-invalid' : ''}}">
						<option disabled selected hidden>{{__('Select monitor')}}</option>
						@foreach($monitors as $monitor)
							<option value="{{$monitor->id}}">{{$monitor->name}}</option>
						@endforeach
					</select>
					@if($errors->hasAny('monitor_id'))
						<div class="invalid-feedback">
							{{  $errors->first('monitor_id') }}
						</div>
					@endif
				</div>
			</div>

			<div class="row mb-2">
				<div class="col-md-4 col-sm-12">
					<label class="col-form-label" for="fieldCaption">{{__('Caption')}}</label>
				</div>
				<div class="col-md-8 col-sm-12">
					<input type="text" name="caption" id="fieldCaption" class="form-control {{$errors->hasAny('caption') ? 'is-invalid' : ''}}" value="{{old('caption')}}"/>
					@if ($errors->hasAny('caption'))
						<div class="invalid-feedback">
							{{  $errors->first('caption') }}
						</div>
					@endif
				</div>
			</div>

			<div class="row mb-2">
				<div class="col-md-4 col-sm-12">
					<label class="col-form-label" for="fieldAssignedTo">{{__('Assigned to')}}</label>
				</div>
				<div class="col-md-6 col-sm-12">
					<select name="assigned_user" id="fieldAssignedTo" class="form-select">
						<option {{(old('assigned_user_id') === null ? 'selected' : '')}}></option>

						@foreach($users as $user)
							<option value="{{$user->id}}">{{$user->name}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="row mb-12">
				<div class="col-12">
					<label class="col-form-label" for="fieldComment">{{__('Comment')}}</label>
				</div>
			</div>
			<div class="row mb-2">
				<div class="col-12">
					<textarea class="w-auto" cols="48" rows="10" name="comment">{{_(old('comment'))}}</textarea>
				</div>
			</div>
		</fieldset>
		<a href="{{ route('incidents')}}" class="btn btnCancel">{{__('Back')}}</a>
		<input type="submit" class="btn" value="{{__('Save')}}"/>
	</form>
@endsection