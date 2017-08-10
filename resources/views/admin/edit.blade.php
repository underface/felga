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
			<div class="panel-heading"><h4>Edytuj dane</h4></div>
			<div class="panel-body">

				@if ($errors->any())
					 <div class="alert alert-danger">
						 <h4>Błąd!</h4>
						  <ul>
								@foreach ($errors->all() as $error)
									 <li>{{ $error }}</li>
								@endforeach
						  </ul>
					 </div>
				@endif



				{!! Form::open(['route' => ['admin.update', $user->id],'method' => 'PUT']) !!}

				<div class="form-group">
					{!! Form::label('name', 'Imię i Nazwisko/Nazwa:') !!}
					{!! Form::text('name',$user->name, array('class'=>'form-control input-lg', 'required'=>'','minlength' => '3', 'maxlength'=>'255')) !!}
				</div>
				<div class="form-group">
					{!! Form::label('login', 'Login:') !!}
					{!! Form::text('login',$user->login, array('class'=>'form-control input-lg', 'required'=>'','minlength' => '3', 'maxlength'=>'255')) !!}
				</div>
				<div class="form-group">
					<label for="email">Email: <small class="label label-danger">Jeżeli zostanie zmienione adres do logowania również ulegnie zmianie.</small></label>
					{!! Form::text('email',$user->email, array('class'=>'form-control input-lg', 'required'=>'','minlength' => '7')) !!}
				</div>
				<div class="form-group">
					<label for="password">Hasło: <small class="label label-danger">Zostaw pustę jeśli nie chcesz zmieniać hasła.</small></label>

					{!! Form::text('password',null, array('class'=>'form-control input-lg', 'minlength' => '6' )) !!}
				</div>


				{!! Form::submit('Aktualizuj', array('class'=>'btn btn-primary btn-lg btn-block','style'=>'margin:20px 0 20px 0')) !!}
				{!! Form::close() !!}
			</div>
		</div>

	</div>
</div>
@endsection
