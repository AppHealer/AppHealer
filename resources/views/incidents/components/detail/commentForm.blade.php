<form class="form" method="post" id="commentForm" action="{{route('incidents.comments.submit', ['incident' => $incident])}}">
	@csrf
	<fieldset>
		<textarea name="comment" placeholder="{{__('Type comment here')}}" class="{{$errors->hasAny('comment') ? 'is-invalid' : 'border-black'}} form-control p-3 mb-2 ">{{old('comment')}}</textarea>
		@if ($errors->hasAny('comment'))
			<div class="invalid-feedback">{{$errors->first('comment')}}</div>
		@endif
		<div class="w-100 text-end ">
			<input class="btn" type="submit" value="{{__('Add comment')}}">
		</div>
	</fieldset>
</form>