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


									<!-- Split button -->
									<div class="btn-group">
									  <a href="{{ route('admin.show', $user->id) }}" type="button" class="btn btn-default btn-sm"><i class="fa fa-user" aria-hidden="true"></i> Profil</a>
									  <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									    Opcje <span class="caret"></span>
									    <span class="sr-only">Toggle Dropdown</span>
									  </button>
									  <ul class="dropdown-menu">
 									    <li><a href="{{ route('admin.edit',$user->id) }}"><i class="fa fa-pencil" aria-hidden="true"></i> Edytuj</a></li>
 	 									 <li><a href="{{ route('admin.show', $user->id)}}"><i class="fa fa-universal-access" aria-hidden="true"></i> Aktualizuj dostęp</a></li>
										 <li><a><small>Data dodania: {{ substr($user->created_at,0,10) }} </small></a></li>
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
