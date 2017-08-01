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

               <div class="panel-footer">
                  <button type="button" class="btn btn-success btn-block btn-sm" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i> Dodaj Notatkę</button>
                  <button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target=".bs-example-modal-smSMS"><i class="fa fa-commenting fa-lg" aria-hidden="true"></i> Wyślij SMSa</button>

                     <!--<a href="#" class="btn btn-warning btn-sm btn-block">Edytuj Dane klienta</a>-->
               </div>
            </div>
         </div>

<!-- Panel z notatkami-->
         <div class="col-md-9">





            <div class="panel panel-default">
               <div class="panel-heading">
				<h4>Klienci</h4>
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
               <div class="panel-footer text-center">

               </div>
            </div>
         </div>
      </div>








   </div>
@endsection
