@php
	$axesMax = [200, 1000, 2000, 3000, 4000, 6000, 8000, 12000, 16000, 20000];
	$maxAvg = max(array_map(function($o) { return $o->getAvg();}, $data)) * 1.2;
	foreach (array_reverse($axesMax) as $value) {
		if ($maxAvg < $value) {
			$max = $value ;
		}
	}
@endphp
<svg  width="580" height="370" xmlns="http://www.w3.org/2000/svg">
	<line x1="60" x2="60" y1="00" y2="320" stroke="#000"  stroke-width="1"/>
	@for ($i = 1; $i <= 4; $i++)
		{{$y = 320 - ((300 / 4) * $i)}}
		<text text-anchor="end" class="axeStep" x="50" y="{{$y + 5}}">
			{{number_format(($max / 4) * $i, 0, ' ', ' ')}}
		</text>
		<line x1="60" x2="600" y1="{{$y}}" y2="{{$y}}" stroke="#222" stroke-dasharray="1 4"/>
	@endfor
	<line x1="60" x2="600" y1="320" y2="320" stroke="#444" />

	<polyline fill="none" stroke="#444"
			  points="
						@foreach($data as $value)
							{{70 + ($value->getIndex() * (520/count($data)))}},
							{{ 320 - ((300 / $max) * $value->getAvg()) }}
						@endforeach
						"
	/>
	@foreach($data as $i => $value)
		<circle
				cy="{{ 320 - ((300 / $max) * $value->getAvg()) }}" cx="{{70 + ($value->getIndex() * (520/count($data)))}}"
				r="4" stroke="#1FCFCF" fill="#fff" stroke-width="2"
				data-timeout-point="{{$value->getIndex()}}"
		/>
		<circle
				cy="{{ 320 - ((300 / $max) * $value->getAvg()) }}" cx="{{70 + ($value->getIndex() * ((520/count($data))) )}}"
				r="2" stroke="#1FCFCF" visibility="hidden"  id="timeout-pointInner-{{$value->getIndex()}}"
		/>

		<rect
				x="{{60 + ($value->getIndex() * (520/count($data)))}}"
				width="20" y="0" height="390" fill-opacity="0.1" fill="#fff"
				data-timeout-point="{{$value->getIndex()}}"
		/>

		<text
				y="340" x="{{70 + ($value->getIndex() * (520/count($data)))}}"
				class="dataPointAxeLabel" text-anchor="middle"
		>
			{{explode(" ", $value->getLabel())[0]}}
		</text>
		@if (count(explode(" ", $value->getLabel())) == 2)
			<text
					y="360" x="{{70 + ($value->getIndex() * (520/count($data)))}}"
					class="dataPointAxeLabel" text-anchor="middle"
			>
				{{explode(" ", $value->getLabel())[1]}}
			</text>
		@endif
	@endforeach
	@foreach($data as $i => $value)
		@include(
			'monitors.svg.components.infobox',
			[
				'x' => 80 + ($value->getIndex() * (520/count($data))),
				'y' => 310 - ((300 / $max) * $value->getAvg()),
				'id' => $value->getIndex(),
				'content' => [
					['avg', number_format($value->getAvg(), 0, '', ' ')],
					['min', number_format($value->getMin(), 0, '', ' ')],
					['max', number_format($value->getMax(), 0, '', ' ')],
				]
			]
		)
	@endforeach

</svg>