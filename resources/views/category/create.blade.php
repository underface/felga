@extends('layouts.app')

@section('content')
   <div class="container">
      <div class="panel panel-default">
		<div class="panel-heading">
			<h4>Dodawanie kategorii</h4>
		</div>

         <div class="panel-body">
		    @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                    	@foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
  				   @endforeach
				   </ul>
			   </div>
              @endif


		    <div class="row">
			    <div class="col-md-6 col-md-offset-3">
	                 {!! Form::open(array('route' => 'category.store')) !!}
	                 <div class="form-group">
	                    {!! Form::label('name', 'Nazwa kategorii (unikalna) ') !!}
	                    {!! Form::text('name',null, array('class'=>'form-control input-lg', 'required'=>'','minlength' => '3', 'maxlength'=>'50', 'style'=>'text-transform:uppercase' )) !!}
	                 </div>
	                 <div class="form-group">
	                    {!! Form::label('description', 'Opis Kategorii') !!}
	                    {{ Form::textarea('description',null, array('class'=>'form-control', 'required'=>'', 'rows'=>'3','minlength'=>'5', 'maxlength'=>'100' )) }}
	                 </div>
	                    {!! Form::submit('Dodaj', array('class'=>'btn btn-primary btn-lg btn-block','style'=>'margin:20px 0 20px 0')) !!}
	                 {!! Form::close() !!}
	              </div>
         </div>
      </div>
   </div>
@endsection
