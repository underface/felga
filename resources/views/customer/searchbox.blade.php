@extends('layouts.app')

@section('content')
   <div class="container">
      <div class="panel panel-default">
         <div class="panel-heading">
            <h3><i class="fa fa-search" aria-hidden="true"></i> Szukaj</h3>
         </div>
         <div class="panel-body">



            <div class="col-md-6 col-md-offset-3">
               {!! Form::open(array('route' => 'customer.search')) !!}
               <div class="form-group">
                  {!! Form::label('search', 'Numer telefonu lub nazwa klienta') !!}
                  {!! Form::text('search',null, array('class'=>'form-control input-lg', 'minlength'=>'5' ,'required'=>'','placeholder'=>'Wpisz numer telefonu lub nazwa klienta...', 'style'=>'text-transform:uppercase' )) !!}
               </div>

                  {!! Form::submit('Szukaj', array('class'=>'btn btn-primary btn-lg btn-block','style'=>'margin:20px 0 20px 0')) !!}
               {!! Form::close() !!}
            </div>


         </div>

      </div>
   </div>

@endsection
