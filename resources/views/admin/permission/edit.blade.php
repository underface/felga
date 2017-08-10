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



				{!! Form::open(['route' => ['admin.permission.update', $permission->id],'method' => 'PUT']) !!}

				<div class="form-group">
					{!! Form::label('name', 'Nazwa systemowa') !!}
					{!! Form::text('name',$permission->name, array('class'=>'form-control', 'required'=>'','readonly' => '')) !!}
				</div>
				<div class="form-group">
					{!! Form::label('display_name', 'Nazwa wyświetlana:') !!}
					{!! Form::text('display_name',$permission->display_name, array('class'=>'form-control input-lg', 'required'=>'','minlength' => '3', 'maxlength'=>'255')) !!}
				</div>
				<div class="form-group">
					{!! Form::label('description', 'Opis:') !!}
					{!! Form::text('description',$permission->description, array('class'=>'form-control input-lg', 'required'=>'','minlength' => '3', 'maxlength'=>'255')) !!}
				</div>

				{!! Form::submit('Aktualizuj', array('class'=>'btn btn-primary btn-lg btn-block','style'=>'margin:20px 0 20px 0')) !!}
				{!! Form::close() !!}
			</div>
		</div>

	</div>
</div>
@endsection
