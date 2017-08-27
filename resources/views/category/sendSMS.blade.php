@extends('layouts.app')

@section('content')

<div class="container-fluid">
	@if(Session::has('message'))
		<div class="alert alert-info alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			{{ Session::get('message') }}
		</div>
	@endif

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-success">
            <div class="panel-body">
               <h4>Wysłano SMSa o treści:</h4>
               <blockquote>
                  <p>
                     {{ $request->content }}
                  </p>
                  <footer>Wysyłka do: <strong> {{ $customers->count() }}</strong> numerów.</footer>
               </blockquote>
            </div>
            <hr />
            <div class="panel-body">
               <table class="table table-hover table-strip">
                  <h5>Lista klientów do których wysłano wiadomość.</h5>
                  <thead>
                     <tr>
                        <th>ID.</th>
                        <th>Imię i Nazwisko</th>
                        <th></th>
                        <th>Numer Telefonu</th>
   	                  <th>Kategoria</th>
                        <th></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($customers as $customer)
                        <tr>
                           <td>{{ $customer->id }}</td>
                           <td><a href="{{route('customer.show', $customer->id)}}">{{$customer->name}}</a></td>
                           <td>
                              @if($customer->checked == 0)
                                 <a href="{{ route('customer.checked', $customer->id) }}" class="btn btn-sm btn-success"><i class="fa fa-check-square" aria-hidden="true"></i></a>
                              @endif
                           </td>
                           <td>{{ $customer->number_phone }}</td>
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
		</div>
	</div>
</div>
@endsection
