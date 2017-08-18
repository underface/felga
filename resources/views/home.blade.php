@extends('layouts.app')


@section('content')
    <div class="container">
	    <div class="col-md-4 col-sm-12">

  		  <div class="panel panel-danger">
  		     <div class="panel-heading">
  		  	   <h4><i class="fa fa-external-link" aria-hidden="true"></i> Szybkie Linki</h4>
  		     </div>
  		     <div class="panel-body">

  				<h4>Notatki</h4>
  				<ul>
  					<li><a a href="{{ route('note.index') }}">Lista notatek</a></li>
  					<li><a a href="{{ route('note.create') }}">Dodaj notatkę</a></li>
  					<li><a a href="{{ route('note.notification') }}">Sprawdź powiadomienia</a></li>
  				</ul>
  				<hr />
  				<h4>Klienci</h4>
  				<ul>
  					<li><a a href="{{ route('customer.index') }}">Lista klientów</a></li>
  					<li><a a href="{{ route('customer.create') }}">Dodaj klienta</a></li>
  					<li><a a href="{{ route('customer.searchbox') }}">Szukaj klienta</a></li>
  				</ul>
  				<hr />
  				<h4>Kategorie</h4>
  				<ul>
  					<li><a a href="{{ route('category.index') }}">Lista kategorii</a></li>
  					<li><a a href="{{ route('category.create') }}">Dodaj kategorię</a></li>
  				</ul>
  				<hr />
				<ul>
					<li><a href="{{ route('logout') }}"
					    onclick="event.preventDefault();
							   document.getElementById('logout-form').submit();">
					    Wyloguj
					</a></li>
				</ul>
  		     </div>
  		  </div>
  	  </div>

       <div class="col-md-4 col-sm-12">

			 <div class="panel panel-default">

				 <div class="panel-body">
					 {!! Form::open(array('route' => 'customer.search')) !!}
					  <div class="form-group">
						  {!! Form::label('search', 'Numer telefonu lub nazwa klienta') !!}
						  {!! Form::text('search',null, array('class'=>'form-control input-lg', 'minlength'=>'3' ,'required'=>'','placeholder'=>'Wpisz numer telefonu lub nazwa klienta...', 'style'=>'text-transform:uppercase' )) !!}
					  </div>

						  {!! Form::submit('Szukaj', array('class'=>'btn btn-primary btn-lg btn-block','style'=>'margin:20px 0 20px 0')) !!}
					  {!! Form::close() !!}
				 </div>
			 </div>

			 
		  <div class="list-group">
		    <li class="list-group-item active"><h4><i class="fa fa-bell fa-lg" aria-hidden="true"></i></span> Powiadomienia</h4></li>
		    <a href="{{ route('note.notification', 'old') }}" class="list-group-item">Powiadomienia po terminie <i class="fa fa-bell" aria-hidden="true"></i><span class="label label-danger">{{ $notification_old }}</span></a>
		    <a href="{{ route('note.notification', 'today') }}" class="list-group-item">Powiadomienia na dziś <i class="fa fa-bell" aria-hidden="true"></i><span class="label label-warning">{{ $notification_today }}</span></a>
		    <a href="{{ route('note.notification', 'future') }}" class="list-group-item">Powodomienia w przyszłości <i class="fa fa-bell" aria-hidden="true"></i><span class="label label-default">{{ $notification_future }}</span></a>
		    <a href="{{ route('note.notification') }}" class="list-group-item">Wszystkie powiadomienia <i class="fa fa-bell" aria-hidden="true"></i><span class="label label-default">{{ $notification_all }}</span></a>
		  </div>
	  </div>
	  <div class="col-md-4 col-sm-12">
		  <div class="list-group">
		    <li class="list-group-item active"><h4><i class="fa fa-tags fa-lg" aria-hidden="true"></i></span> Kategorie</h4></li>
		    @foreach ($categories as $category)
			    <a href="{{ route('category.show', $category->id) }}" class="list-group-item"><i class="fa fa-tag" aria-hidden="true"></i> <strong>{{ $category->name}}</strong> - Zainteresowanych klientów: <strong><i class="fa fa-user" aria-hidden="true"></i> {{ $category->customers()->count() }}</strong></a>
		    @endforeach
		  </div>
	  </div>

    </div>
@endsection
