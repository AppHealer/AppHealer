<fieldset class="border border-black p-2 mb-3">
	<div class="row border-bottom m-0">
		<div class="col-6 fw-bold p-1 pt-0">
			{{$item->createdBy ? $item->createdBy->name : 'AppHealer'}}
		</div>
		<div class="col-6 text-end p-1 pt-0">
			{{$item->datetime_created}}
		</div>
	</div>
	<div class="p-2">
		{!! nl2br($item->comment) !!}
	</div>
</fieldset>