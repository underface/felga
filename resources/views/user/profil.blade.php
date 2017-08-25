@extends('layouts.app')

@section('scripts')

@endsection

@section('content')
   <div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<div class="list-group">
		 		    <li class="list-group-item active"><h4><i class="fa fa-bell fa-lg" aria-hidden="true"></i></span> Ostatnio dodani klienci </h4></li>
					 @foreach($customers as $customer)
						 <li class="list-group-item">
							 <div class="row">
								<div class="col-md-4"><b>{{$customer->name}}</b></div>
								<div class="col-md-2">{{$customer->number_phone}}</div>
								<div class="col-md-4"><i class="fa fa-calendar" aria-hidden="true"></i> <i>{{$customer->created_at}}</i></div>
								<div class="col-md-2"><a href="{{ route('customer.show', $customer->id) }}" class="pull-right btn btn-info btn-sm"><i class="fa fa-user" aria-hidden="true"></i> Profil</a></div>
							 </div>
						 </li>
					 @endforeach
					 <li class="list-group-item">
						 <div class="row">
							 <div class="col-md-12">

							 <div class="btn-group pull-right" role="group" aria-label="...">
							  <a href="{{route('customer.create')}}" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Nowy Klient</a>
							  <a href="{{route('customer.searchbox')}}" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i> Szukaj</a>
							  <a href="{{route('customer.index')}}" class="btn btn-default"><i class="fa fa-users" aria-hidden="true"></i> Wszyscy klienci</a>
							</div>
						</div>
						 </div>

					 </li>
			 	</div>
			</div>
			<div class="col-md-6">

				<div class="list-group">
					 <li class="list-group-item active"><h4><i class="fa fa-bell fa-lg" aria-hidden="true"></i></span> Ostatnio dodane notatki</h4></li>
					 @foreach($notes as $note)
						 <li class="list-group-item">
							 <div class="row">
								 <div class="col-md-8"><span class="label label-default">{{$note->id}}</span><b>{{$note->title }}</div>
									 <div class="col-md-1">
										 @if ($note->notification)
											 <span class="label label-danger"><i class="fa fa-bell-o" aria-hidden="true"></i></span>
										 @endif
									 </div>
								 <div class="col-md-3">{{ substr($note->created_at,0,10) }}</div>

							 </div>
							 <hr />
							 <div class="row">
								 <div class="col-md-10">
									<i>{{ substr($note->content,0,150) }}...</i>
								 </div>
								 <div class="col-md-2">
									<a href="{{route('customer.show',$note->customer_id)}}" class="btn btn-xs btn-info">Profil</a>
								 </div>
							 </div>
						 </li>
					 @endforeach
					 <li class="list-group-item">
						 <div class="row">
							 <div class="col-md-12">

							 <div class="btn-group pull-right" role="group" aria-label="...">
							  <a href="{{route('note.create')}}" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Dodaj notatkę</a>
							  <a href="{{route('note.index')}}" class="btn btn-default"><i class="fa fa-users" aria-hidden="true"></i> Wszystkie notatki</a>
							</div>
						</div>
						 </div>

					 </li>
				</div>

			</div>
		</div>

   </div>

@endsection
