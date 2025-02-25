@php
	$axeStep = 10;
@endphp
<svg  width="580" height="370" xmlns="http://www.w3.org/2000/svg">
	<line x1="60" x2="60" y1="00" y2="320" stroke="#000"  stroke-width="1"/>
	@foreach($data as $i => $value)
		@if ($value->getTotal() !== 0)
			<rect
					x="{{70 + ($value->getIndex() * (520/count($data)))}}"
					width="{{(520 / count($data)) - 10}}"
					y="{{320 - (300 * $value->getOk() / $value->getTotal()) }}"
					height="{{(300 * $value->getOk() / $value->getTotal()) }}"
					fill="#1FCFCF"
			></rect>
		@endif
		<text
			y="340" x="{{80 + ((($value->getIndex()) + 0.5)  * (520/count($data)))}}"
			class="dataPointAxeLabel" text-anchor="end"
		>
			{{explode(" ", $value->getLabel())[0]}}
		</text>
		@if (count(explode(" ", $value->getLabel())) == 2)
			<text
				y="360" x="{{80 + ((($value->getIndex()) + 0.5)  * (520/count($data)))}}"
				class="dataPointAxeLabel"  text-anchor="end"
			>
			{{explode(" ", $value->getLabel())[1]}}
			</text>
		@endif
	@endforeach


	@for ($i = 1; $i <= 100 / $axeStep; $i++)
		{{$y = 320 - ((300 / (100 / $axeStep)) * $i)}}
		<text class="axeStep"  text-anchor="end" x="50" y="{{$y + 5}}">
			{{$axeStep * $i}} %
		</text>
		<line x1="60" x2="600" y1="{{$y}}" y2="{{$y}}" stroke="#222" stroke-dasharray="1 4"/>
	@endfor
	<line x1="60" x2="600" y1="320" y2="320" stroke="#444" />

</svg>