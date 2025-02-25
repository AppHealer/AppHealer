<form class="mt-2 mb-1">
	<div class="row">
		<div class="col-auto">
			<input type="datetime-local" class="form-control" name="dateFrom" value="{{$dateFrom}}"/>
		</div>
		<div class="col-auto p-1">-</div>
		<div class="col-auto">
			<input type="datetime-local" class="form-control" name="dateTo" value="{{$dateTo}}"/>
		</div>
		<div class="col-auto">
			<input type="submit" class="btn" value="{{__('Show data')}}">
		</div>
	</div>
	@if ($rangeErrorMsg !== null)
		<div class="row p-2">
			<div class="col-3 alert alert-info">
				{{$rangeErrorMsg}}
			</div>
		</div>
	@endif
</form>