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
			<div class="panel-heading"><h4>{{ $user->name }}</h4></div>
			<div class="panel-body">
				<label>Login:</label> {{ $user->login}}<br />
				<label>Email:</label> {{ $user->email}}<br />
				<label>Dodano:</label> {{ $user->created_at}}<br />
				<hr />
				<div class="row">
					<div class="col-md-12">
						<a href="{{ route('admin.edit',$user->id) }}" class="btn btn-warning">Edytuj</a>
						@if($user->roles->count())
							<a href="{{ route('admin.deleteaccess', $user->id) }}" class="btn btn-danger">Usuń dostęp do systemu</a>
						@elseif ($user->roles->count() === 0)
							<a href="{{ route('admin.access', $user->id)}}" class="btn btn-success">Włącz dostęp do systemu</a>
						@endif
					</div>
				</div>
				<hr />
				<!--panel  z uprawnieniami-->
				<div class="row">
					<div class="col-md-6">
						<h4>Role:</h4>
						<ul>
							@foreach ($user->roles as $role)
								<li><b>{{$role->display_name}}</b>
									<ul>
										@foreach ($role->permissions as $permission)
										<li><i class="fa fa-check" aria-hidden="true"></i> {{$permission->display_name}}</li>
										@endforeach
									</ul>
								</li>
							@endforeach
						</ul>
					</div>
					<div class="col-md-6">
						<h4>Uprawnienia:</h4>
						<ul>
							@foreach ($user->permissions as $permission)
								<li><i class="fa fa-check" aria-hidden="true"></i> {{ $permission->display_name }}</li>
							@endforeach
						</ul>
					</div>
				</div>

			</div>
		</div>

	</div>
</div>
@endsection
