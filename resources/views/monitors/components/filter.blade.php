<form id="monitorsFilter" class="monitorFilter mb-2 mt-2 p-1">
	<div class="row">
		<div class="col-auto">
			<div class="input-group">
				<span class="input-group-addon"><span class="fa fa-search"></span></span>
				<input autocomplete="off" type="text" class="form-control" placeholder="search" name="search" id="monitorsFilterSearch"/>
			</div>
		</div>
		<div class="col"></div>
		<div class="col text-end">
			<div class="input-group">
				<span class="input-group-addon"><span class="fa fa-sort-alpha-asc"></span></span>
				<select class="form-select" id="monitorsFilterSort">
					<option value="down">{{__ ('Down first')}}</option>
					<option value="up">{{__ ('Up first')}}</option>
					<option value="alphabetical">{{__ ('Alphabetical ')}}</option>
				</select>
			</div>
		</div>
	</div>
</form>