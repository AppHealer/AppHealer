@extends('_layouts.app', ['page' => 'dashboard', 'title' => 'Dashboard'])
@section('content')
<div class="dashboard">
	<div class="row mb-2">
		<div class="col-auto">
			@include('dashboard.cards.monitorsSlowest')
		</div>

		<div class="col-auto">
			@include('dashboard.cards.monitorsFailed')
		</div>
		<div class="col"></div>
	</div>

	<div class="row">
		<div class="col">

			<div class="card">
				<div class="card-title"><span class="fa fa-user-shield"></span>{{ __('Last Logins') }}</div>
				<div data-route="{{ route('dashboard.lastLogins', [], false) }}" data-refresh="10">
				</div>
			</div>
		</div>
	</div>
</div>
@endsection