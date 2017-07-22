@extends('layouts.app')


@section('content')
    <div class="container">
       <div class="col-md-4 col-sm-12">
		  <div class="list-group">
		    <li class="list-group-item active"><h4><i class="fa fa-bell fa-lg" aria-hidden="true"></i></span> Powiadomienia</h4></li>
		    <a href="{{ route('note.notification', 'old') }}" class="list-group-item">Powiadomienia po terminie <i class="fa fa-bell" aria-hidden="true"></i><span class="label label-danger">{{ $notification_old }}</span></a>
		    <a href="{{ route('note.notification', 'today') }}" class="list-group-item">Powiadomienia na dziś <i class="fa fa-bell" aria-hidden="true"></i><span class="label label-warning">{{ $notification_today }}</span></a>
		    <a href="{{ route('note.notification', 'future') }}" class="list-group-item">Powodomienia w przyszłości <i class="fa fa-bell" aria-hidden="true"></i><span class="label label-default">{{ $notification_future }}</span></a>
		    <a href="{{ route('note.notification') }}" class="list-group-item">Wszystkie powiadomienia <i class="fa fa-bell" aria-hidden="true"></i><span class="label label-default">{{ $notification_all }}</span></a>
		  </div>
	  </div>
	  <div class="col-md-4 col-sm-12">
		  <div class="panel panel-success">
			<div class="panel-heading">
				<h4>Dodatkowy panel</h4>
			</div>
			<div class="panel-body">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</div>
		  </div>

	  </div>
	  <div class="col-md-4 col-sm-12">
		  <div class="panel panel-danger">
		     <div class="panel-heading">
		  	   <h4>Dodatkowy panel #2</h4>
		     </div>
		     <div class="panel-body">
		  	   Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		     </div>
		  </div>
	  </div>
    </div>
@endsection
