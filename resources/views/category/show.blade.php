@extends('layouts.app')

@section('content')

   <div class="container">
      @if(Session::has('message'))
         <div class="alert alert-info alert-dismissible" role="alert">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           {{ Session::get('message') }}
         </div>
      @endif

      <div class="row">
         <div class="col-md-3">
            <div class="panel panel-default">
               <div class="panel-heading">
                  <h4>#{{ $category->name}}</h4>
               </div>
               <div class="panel-body">
						{{ $category->description}}
               </div>

            </div>
         </div>

<!-- Panel z notatkami-->
         <div class="col-md-9">

            <div class="panel panel-default">
					@if ($errors->any())
	                <div class="alert alert-danger">
							 <h4>Błąd!</h4>
	                    <p>
								Nie wpisano treści wiadomości lub nie wybrano klientów do wysyłki!
							  </p>
	                </div>
	            @endif
			  {!! Form::open(array('route' => 'sendSMS.send')) !!}
               <div class="panel-heading">
				<h4>Lista klientów z tej kategorii</h4>
               </div>
               <div class="panel-body">
				<div class="table-responsive">
		             <table class="table table-hover table-strip">
		                <thead>
		                   <tr>
		                      <th><i class="fa fa-check-square-o fa-lg" aria-hidden="true"></i></th>
		                      <th>Imię i Nazwisko</th>
		                      <th>Numer Telefonu</th>
		 				 <th>Kategoria</th>
		                      <th></th>
		                   </tr>
		                </thead>
		                <tbody>

		                   @foreach ($category->customers as $customer)
		                      <tr>
		                         <td><input type="checkbox" name="customer_id[]" value="{{ $customer->id }}"  class="form-controll"/></td>
		                         <td><a href="{{route('customer.show', $customer->id)}}"><h5>{{$customer->name}}</h5></a></td>
		                         <td>{{$customer->number_phone}}</td>
		 				    <td>
		 					    @foreach ($customer->categories as $category)
		 						    <span class="label label-default"><a href="{{ route('category.show', $category->id) }}">#{{ $category->name }}</a></span>

		 					    @endforeach

		 				    </td>
		                         <td><a href="{{route('customer.show', $customer->id)}}" class="btn btn-info btn-sm pull-right"> <i class="fa fa-address-card-o fa-lg" aria-hidden="true"></i> Profil & Notatki</a></td>
		                      </tr>

		                   @endforeach

		                </tbody>

		             </table>
	 	  	</div>
               </div>
               <div class="panel-footer ">
				<div class="form-group">
				   {!! Form::label('content', 'Treść wiadomości:') !!}
				   {!! Form::textarea('content', (isset($request->content) ? $request->content : ""), array('class'=>'form-control ', 'required'=>'', 'rows'=>'3', 'placeholder'=> 'Tu wpisz treść wiadomości SMS', 'id'=>'content_sms' )) !!}
					<span class="label label-info"><span id="HowMany">0</span> znaków.</span>
					<span class="label label-warning">1 SMS to max 160 znaków.</span>
				</div>
				{{ Form::hidden('category_id', $category->id) }}
				{!! Form::submit('Wyślij', array('class'=>'btn btn-primary btn-block','style'=>'margin:5px 0px')) !!}
               </div>
			{!! Form::close() !!}
            </div>
         </div>
      </div>








   </div>
@endsection
@section('scripts')

	<script>
	$("#content_sms").on("input", function() {
	 $("#HowMany").text(this.value.length);

	});
	</script>

@endsection
