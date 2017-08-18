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
				<div class="row">
					<div class="col-md-8">
						<label>Login:</label> {{ $user->login}}<br />
						<label>Email:</label> {{ $user->email}}<br />
						<label>Dodano:</label> {{ $user->created_at}}<br />
					</div>
					<div class="col-md-4">
							<a href="{{ route('admin.edit',$user->id) }}" class="btn btn-warning btn-block btn-sm">Edytuj</a>
							<hr />
							{!! Form::open(array('route' => array('admin.access', $user->id))) !!}

							@foreach ($roles as $role)
								@if($role->name !== "released")
									<label class="btn-block btn btn-sm btn-default"><input type="checkbox" name="roles[]" value="{{ $role->id }}"
										@foreach($user->roles as $user_role)
											@if($user_role->id == $role->id)
												checked
											@endif
										@endforeach								
										/> {{$role->display_name}}</label>
								@endif
							@endforeach

								{!! Form::submit('Aktualizuj uprawnienia', array('class'=>'btn btn-primary btn-block','style'=>'margin:5px 0 5px 0')) !!}
							{!! Form::close() !!}

								<hr />
								@if($user->roles->count())
									<a href="{{ route('admin.deleteaccess', $user->id) }}" class="btn btn-danger btn-block btn-sm">Usuń dostęp do systemu</a>
								@endif
					</div>
				</div>

				<!--panel  z uprawnieniami-->
				@if(count($user->roles) > 0)
					<hr />
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
				@endif

			</div>
		</div>

	</div>
</div>
@endsection
