@extends('layouts.app')

@section('content')
	<div class="container">

@if(Session::has('message'))
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-success" role="alert">
						{{ Session::get('message') }}
				</div>
			</div>
		</div>
@endif

		@include('admin.menu')


	<div class="col-md-9">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="row">
					<div class="col-md-9">
						<h4>Uprawnienia dostępu</h4>
					</div>
					<div class="col-md-3">
						<a href="{{ route('admin.permission.create') }}" class="btn btn-success pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> Dodaj uprawnienie</a>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Nazwa</th>
							<th>Nazwa systemowa</th>
							<th>Opis</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($permissions as $permission)
							<tr>
								<td><h5>{{$permission -> display_name}}</h5></td>
								<td><small>{{$permission->name}}</small></td>
								<td>{{$permission->description}}</td>
								<td><a href="{{ route('admin.permission.edit',$permission->id) }}" class="btn btn-xs btn-default "><i class="fa fa-pencil" aria-hidden="true"></i> Edytuj</a></td>
								<td>
									@role('superadministrator')
										<a href="{{ route('admin.permission.delete', $permission->id) }}" onclick="event.preventDefault();
											  document.getElementById('del-form{{$permission->id}}').submit();"class="btn btn-xs btn-danger pull-right "><i class="fa fa-trash-o" aria-hidden="true"></i> Usuń</a>

										<form id="del-form{{$permission->id}}" action="{{ route('admin.permission.delete', $permission->id) }}" method="POST" style="display: none;">
											<input type="hidden" name="_method" value="DELETE" />
			 							 {{ csrf_field() }}
			 						  </form>
									  @endrole
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

	</div>
</div>
@endsection
