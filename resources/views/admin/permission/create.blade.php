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

		<div class="panel panel-default">
			<div class="panel-heading"><h4>Uprawnienia dostępu</h4></div>

			<div class="panel-body">
				<div class="col-md-6 col-md-offset-3">
					{!! Form::open(array('route' => 'admin.permission.store')) !!}
					<div class="form-group">
						<label for="display_name">Nazwa uprawnienia:</label>
						{!! Form::text('display_name',null, array('class'=>'form-control input-lg', 'required'=>'','minlength' => '4', 'maxlength'=>'255' )) !!}
					</div>
					<div class="form-group">
						<label for="name">Nazwa systemowa:<span class="label label-warning">Małe litery bez spacji (zamiennie "_")</span></label>
						{!! Form::text('name',null, array('class'=>'form-control input-lg', 'required'=>'','minlength' => '4','maxlength' => '9', 'style' => 'text-transform: lowercase;' )) !!}
					</div>
					<div class="form-group">
						{!! Form::label('description', 'Opis:') !!}
						{!! Form::text('description',null, array('class'=>'form-control input-lg', 'minlength' => '4')) !!}
					</div>
					{!! Form::submit('Dodaj', array('class'=>'btn btn-primary btn-lg btn-block','style'=>'margin:20px 0 20px 0')) !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
