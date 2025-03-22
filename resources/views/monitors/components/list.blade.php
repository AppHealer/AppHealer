<table class="table monitors w-auto">
	<thead class="table-light">
	<tr>
		<th class="align-middle" colspan="2">{{__('Name')}}</th>
		<th class="align-middle">{{__('Timeout')}}</th>
		<th>{{__('Uptime')}} <br> {{__('24 H')}}</th>
		<th class="d-none d-md-table-cell">&nbsp;</th>
		<th class="d-none d-md-table-cell align-middle text-end">{{__('Last check')}}</th>
	</tr>

	</thead>
	<tbody>
	@foreach($monitors as $monitor)
		@include('monitors.components.list.row')
	@endforeach
	</tbody>
</table>