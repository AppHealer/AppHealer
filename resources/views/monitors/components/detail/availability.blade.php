<div class="col-auto availability border border-2 text-center p-2">
	<div class="row">
		<div class="col border-bottom">
			<h3>{{__('Availability')}}</h3>
			<div class="mainValue  mb-2">
					{{number_format($summary->getOk() * 100 / $summary->getTotal(), 1, '.' )  }} %
			</div>
		</div>
	</div>
	<div class="row p-2">
		<div class="col-auto">
			<h4>Total</h4>
			<span class="value">
					{{$summary->getTotal()}}
			</span>
		</div>
		<div class="col-auto ok">
			<h4>Ok</h4>
			<span class="value">
				{{$summary->getOk()}}
			</span>
		</div>
		<div class="col-auto failed">
			<h4>Failed</h4>
			<span class="value">
				{{$summary->getFailed()}}
			</span>
		</div>
	</div>
</div>