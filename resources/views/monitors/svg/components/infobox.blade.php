@php
	$lineHeight = 17;
	$width = 100;
	$x -= 40;
	$y -= 40;

	if ($x + $width > 580) {
		$x = 480;
	}

	if ($y > 300) {
		$y = 235;
	}

	if ($y < 40)  {
		$y = 50;
	}


@endphp

<rect
		x="{{$x}}"
		y="{{$y - 2 - $lineHeight}}"
		width="{{$width}}"
		height="{{11 + count($content) * $lineHeight}}"
		data-infobox="{{$value->getIndex()}}"
		data-point="{{$value->getIndex()}}"
		visibility="hidden" class="infobox"
/>
@foreach($content as $row => $text)
	@if (is_array($text))
		<text class="infobox" data-infobox="{{$value->getIndex()}}"	visibility="hidden"	y="{{$y + $row * $lineHeight }}" x="{{$x + 10}}">
			{{$text[0]}}
		</text>>
		<text class="infobox" data-infobox="{{$value->getIndex()}}"	visibility="hidden"	y="{{$y + $row * $lineHeight}}" x="{{$x - 10 + $width}}" text-anchor="end">
			{{$text[1]}}
		</text>
	@else
		<text class="infobox" data-infobox="{{$value->getIndex()}}"	visibility="hidden"	y="{{$y + $row * $lineHeight}}" x="{{$x + 10}}">
			{{$text}}
		</text>
	@endif
@endforeach
