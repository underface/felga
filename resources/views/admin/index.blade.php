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
			<div class="panel-heading"><h4>Lista użytkowników</h4></div>
			<div class="panel-body">
				<table class="table table-hover table-striped">
					<thead>
							<tr>
								<th>Nazwa</th>
								<th>email</th>
								<th>Rola</th>
								<th>Aktywny</th>
								<th>Opcje</th>
							</tr>
					</thead>
					<tbody>
						@foreach ($users as $user)
							<tr>
								<td>{{ $user->name }}<br />
								<small>({{ $user->login }})</small>
							</td>

								<td>{{ $user->email }}</td>
								<td>@foreach ($user->roles as $user_role)
									<small>{{ $user_role->display_name }}</small><br />
									@endforeach
								</td>
								<td>
									@if($user->roles->count())
										<i class="fa fa-toggle-on fa-lg" aria-hidden="true"></i>
									@else
										<i class="fa fa-toggle-off fa-lg" aria-hidden="true"></i>
									@endif

								</td>
								<td>

								<div class="btn-group">
								  <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    Opcje <span class="caret"></span>
								  </button>
								  <ul class="dropdown-menu">
								    <li><a href="{{ route('admin.show', $user->id) }}">Profil</a></li>
								    <li><a href="{{ route('admin.edit',$user->id) }}">Edytuj</a></li>
									 <li role="separator" class="divider"></li>
									 @if($user->roles->count())
 										<li><a href="{{ route('admin.deleteaccess', $user->id)}}">Usuń uprawnienia</a></li>
 									@else
 										<li><a href="{{ route('admin.access', $user->id)}}#">Dodaj uprawnienia</a></li>
 									@endif


								  </ul>
								</div>
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
