@extends('_layouts.app', ['page' => 'monitors', 'title' => __('Monitors')])
@section('content')
	<a class="btn" href="{{route('monitors.create')}}">{{__('New monitor')}}</a>
	@include('monitors.components.list.filter')
	<div id="monitors" data-route="{{ route('monitors.list', [], false) }}" data-refresh="1">
	@include('monitors.components.list')

@endsection