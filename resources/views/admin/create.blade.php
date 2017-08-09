@extends('layouts.app')

@section('content')
   <div class="container">

@include('admin.menu')


	<div class="col-md-9">
		<div class="panel panel-default">
			<div class="panel-heading"><h4>Dodaj użytkownika</h4></div>
			<div class="panel-body">

				{!! Form::open(array('route' => 'admin.store')) !!}
				<div class="form-group">
					{!! Form::label('name', 'Imię i Nazwisko:') !!}
					{!! Form::text('name',null, array('class'=>'form-control input-lg', 'required'=>'','minlength' => '3', 'maxlength'=>'255' )) !!}
				</div>
				<div class="form-group">
					{!! Form::label('login', 'Login:') !!}
					{!! Form::text('login',null, array('class'=>'form-control input-lg', 'required'=>'','minlength' => '3', 'maxlength'=>'255' )) !!}
				</div>
				<div class="form-group">
					{!! Form::label('email', 'E:mail:') !!}
					{!! Form::text('email',null, array('class'=>'form-control input-lg', 'required'=>'','minlength' => '7')) !!}
				</div>
				<div class="form-group">
					{!! Form::label('password', 'Hasło:') !!}
					{!! Form::text('password',null, array('class'=>'form-control input-lg', 'minlength' => '6' )) !!}
				</div>


				{!! Form::submit('Dodaj', array('class'=>'btn btn-primary btn-lg btn-block','style'=>'margin:20px 0 20px 0')) !!}
				{!! Form::close() !!}


			</div>
		</div>

	</div>
</div>
@endsection
