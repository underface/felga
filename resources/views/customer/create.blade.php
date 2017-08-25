@extends('layouts.app')

@section('scripts')
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endsection

@section('content')
   <div class="container-fluid">
      <div class="panel panel-default">
         <div class="panel-heading">
            <h3>Dodaj Klienta</h3>
         </div>
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


            <div class="col-md-6 col-md-offset-3">
               {!! Form::open(array('route' => 'customer.store')) !!}
               <div class="form-group">
                  {!! Form::label('name', 'Imię i Nazwisko:') !!}
                  {!! Form::text('name',null, array('class'=>'form-control input-lg', 'required'=>'','minlength' => '6', 'maxlength'=>'255', 'style'=>'text-transform:uppercase' )) !!}
               </div>
               <div class="form-group">
                  {!! Form::label('number_phone', 'Numer Telefonu:') !!}
                  {!! Form::text('number_phone',null, array('class'=>'form-control input-lg', 'required'=>'','minlength' => '9','maxlength' => '9', 'onkeypress'=>'return isNumberKey(event)' )) !!}
               </div>
					<div class="form-group">
                  {!! Form::label('email', 'Adres email:') !!}
                  {!! Form::text('email',null, array('class'=>'form-control input-lg', 'minlength' => '5' )) !!}
               </div>

			@if(count($categories))
				<div class="form-group">
					{!! Form::label('categories', 'Wybierz kategorię:') !!}
					@foreach ($categories as $category)
						<label class="form-control"><input  type="checkbox" name="categories[]" value="{{$category->id}}" /> {{$category->name}}</label>
					@endforeach

				</div>
			@endif

               {!! Form::submit('Zapisz', array('class'=>'btn btn-primary btn-lg btn-block','style'=>'margin:20px 0 20px 0')) !!}
               {!! Form::close() !!}
            </div>


         </div>

      </div>
   </div>

   <script>
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>
@endsection
