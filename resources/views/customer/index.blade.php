@extends('layouts.app')

@section('content')
   <div class="container-fluid">
      <div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<div class="col-md-8 col-sm-12">
					<h4>
						@if(Session::has('message'))
							{{ Session::get('message') }}
						@else
							Lista Klientów
						@endif
					</h4>
				</div>
				<div class="col-md-4 col-sm-12">
					<div class="btn-group pull-right" role="group" aria-label="...">
					  <a href="{{ route('customer.create') }}" class="btn btn-primary"><i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i> Nowy Klient</a>
					  <a href="{{ route('customer.searchbox') }}" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i> Szukaj</a>
					</div>
				</div>
			</div>
		</div>

         <div class="panel-body">
		    <div class="table-responsive">
            <table class="table table-hover table-strip">
               <thead>
                  <tr>
                     <th>ID.</th>
                     <th>Imię i Nazwisko</th>
                     <th>Numer Telefonu</th>
				 <th>Kategoria</th>
                     <th></th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($customers as $customer)
                     <tr>
                        <td>{{$customer->id}}</td>
                        <td><a href="{{route('customer.show', $customer->id)}}">{{$customer->name}}</a></td>
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
            {!! $customers->links(); !!}
         </div>
      </div>
   </div>
@endsection
