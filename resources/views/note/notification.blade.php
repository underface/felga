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
			<div class="list-group">
			  <li class="list-group-item active"><h4><i class="fa fa-bell fa-lg" aria-hidden="true"></i></span> Powiadomienia</h4></li>
			  <a href="{{ route('note.notification', 'old') }}" class="list-group-item">Powiadomienia po terminie <i class="fa fa-bell" aria-hidden="true"></i><span class="label label-danger">{{ $notification_old }}</span></a>
			  <a href="{{ route('note.notification', 'today') }}" class="list-group-item">Powiadomienia na dziś <i class="fa fa-bell" aria-hidden="true"></i><span class="label label-warning">{{ $notification_today }}</span></a>
			  <a href="{{ route('note.notification', 'future') }}" class="list-group-item">Powodomienia w przyszłości <i class="fa fa-bell" aria-hidden="true"></i><span class="label label-default">{{ $notification_future }}</span></a>
			  <a href="{{ route('note.notification') }}" class="list-group-item">Wszystkie powiadomienia <i class="fa fa-bell" aria-hidden="true"></i><span class="label label-default">{{ $notification_all }}</span></a>
		  </div>
		</div>
		<div class="col-md-9">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4><i class="fa fa-bell fa-lg" aria-hidden="true"></i></span>
						@if(Session::has('type'))
							{{ Session::get('type') }}
						@endif
					</h4>

				</div>
				<div class="panel-body">
					@foreach ($notes as $note)
						<div class="panel panel-danger panel-note">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-8 col-sm-12">
										<h5><span class="label label-default">ID: #{{ $note->id}}</span> {{$note->title }}</h5>
									</div>
									<div class="col-md-4 col-sm-12">
										<span class="label label-danger"><i class="fa fa-bell" aria-hidden="true"></i> Powiadomienie! <i class="fa fa-clock-o" aria-hidden="true"></i>  {{ $note->notification_date }}</span>
									</div>
								</div>



							</div>
							<div class="panel-body">
								{{ $note->content }}
								<br />
			                         <a href="{{ route('customer.show', $note->customer_id) }}" class="btn btn-sm btn-default"><small><i class="fa fa-user" aria-hidden="true"></i>: {{ $note->customer->name }}</small></a>

							</div>
							<div class="panel-footer">
								<div class="row">
								   <div class="col-md-10">
									 <small><i class="fa fa-at" aria-hidden="true"></i>{{ $note->user->name}} <i class="fa fa-calendar-o" aria-hidden="true"></i>: {{ $note->created_at }} <i class="fa fa-calendar-check-o" aria-hidden="true"></i>: {{$note->updated_at }}</small>
									 @if ($note->notification == 1)
									    {!! Form::open(array('route' => array('note.delNotification', $note->id), 'method' => 'PUT')) !!}
										  {!! Form::hidden('note_id', $note->id) !!}
										  <button class="btn btn-xs btn-info" type="submit"><i class="fa fa-times" aria-hidden="true"></i> Usuń powiadomienie</button>
									    {!! Form::close()!!}

									 @endif
								   </div>
								   <div class="col-md-2">
									 {!! Form::open(array('route' => array('note.destroy', $note->id), 'method' => 'DELETE')) !!}
									    <button class="btn btn-xs btn-danger pull-right" type="submit"><i class="fa fa-times" aria-hidden="true"></i> Usuń notatkę</button>
									 {!! Form::close()!!}
								   </div>
								</div>
							</div>
						</div>
					@endforeach


				</div>
				<div class="panel-footer text-center">
					{{ $notes->links() }}
				</div>
			</div>
		</div>
	   </div>
   </div>
@endsection
