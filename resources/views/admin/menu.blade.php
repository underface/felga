<div class="col-md-3">
	<div class="panel panel-primary">
		<div class="panel-heading"><h4>Menu</h4></div>
		<div class="panel-body">
			<a href="{{route('admin.index')}}"> Lista pracowników</a><hr />
			<a href="{{route('admin.create')}}"> Dodaj pracownika</a><hr />
			@role('superadministrator')
				<a href="{{route('admin.role.index')}}"><i class="fa fa-universal-access" aria-hidden="true"></i> Role w systemie</a><hr />
				<a href="{{route('admin.permission.index')}}"><i class="fa fa-universal-access" aria-hidden="true"></i> Uprawnienia w systemie</a><hr />
			@endrole
		</div>
	</div>
</div>
