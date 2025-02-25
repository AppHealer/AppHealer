<div class="col-auto timeout border border-2 text-center p-2">
	<h3>Timeout (avg)</h3>
	<div class="row border-bottom">
		<div class="mainValue text-center mb-2">
			@if ($summary->getTotal() !== 0)
				{{number_format($summary->getAvg(), 0, ' ', ' ' )}} ms
			@else
				<span class="nodata">{{__('No data')}}</span>
			@endif
		</div>
	</div>
	@if ($summary->getTotal() !== 0)

		<div class="row p-2">
			<div class="col-auto">
				<h4>Min</h4>
				<span class="value">
					{{number_format($summary->getMin(), 0, ' ', ' ' )}} ms

				</span>
			</div>
			<div class="col-auto">
				<h4>Max</h4>
				<span class="value">
					{{number_format($summary->getMax(), 0, ' ', ' ' )}} ms
				</span>
			</div>
		</div>
	@endif
</div>