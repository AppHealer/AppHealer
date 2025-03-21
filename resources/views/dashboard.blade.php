@extends('_layouts.app', ['page' => 'dashboard', 'title' => 'Dashboard'])
@section('content')
<div class="dashboard">
	<div class="row mb-3">
		<div class="col-xl-3 col-md-6 col-sm-12 mb-3 mb-md-0">
			@include('dashboard.cards.monitorsSlowest')
		</div>

		<div class="col-xl-3 col-md-6 col-sm-12">
			@include('dashboard.cards.monitorsFailed')
		</div>
		<div class="col"></div>
	</div>

	<div class="row">
		<div class="col-xl-3 col-md-6 col-sm-12">

			<div class="card">
				<div class="card-title"><span class="fa fa-user-shield"></span>{{ __('Last Logins') }}</div>
				<div data-route="{{ route('dashboard.lastLogins', [], false) }}" data-refresh="10">
				</div>
			</div>
		</div>
	</div>
</div>
@endsection