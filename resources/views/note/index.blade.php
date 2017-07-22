@extends('layouts.app')

@section('content')
   <div class="container">
      <div class="panel panel-default">
         <div class="panel-heading">
            <h3>Notatki
               <a href="#" class="btn btn-primary pull-right "><i class="fa fa-plus-circle" aria-hidden="true"></i> Nowa Notatka</a>
            </h3>
         </div>
         <div class="panel-body">
            @foreach ($notes as $note)

               <div class="panel
                  @if ($note->notification == 1)
                     panel-danger
                  @else
                     panel-default
                  @endif
                  panel-note
               ">
               <div class="panel-heading">
                  <h5><span class="label label-default">ID: #{{ $note->id}}</span> {{$note->title }}</h5>
               </div>
                  <div class="panel-body">

                     {{ $note->content }}

                     @if ($note->notification == 1)
                        <br/><span class="label label-danger"><i class="fa fa-bell" aria-hidden="true"></i> Powiadomienie! <i class="fa fa-clock-o" aria-hidden="true"></i>  {{ $note->notification_date }}</span>
                     @endif
                     <br />
                     <a href="{{ route('customer.show', $note->customer_id) }}" class="btn btn-sm btn-default"><small><i class="fa fa-user" aria-hidden="true"></i>: {{ $note->customer->name }}</small></a>
                  </div>
                  <div class="panel-footer">
                     <div class="row">
                        <div class="col-md-10">
                           <small><i class="fa fa-at" aria-hidden="true"></i>{{ $note->user->name}} <i class="fa fa-calendar-o" aria-hidden="true"></i>: {{ $note->created_at }} <i class="fa fa-calendar-check-o" aria-hidden="true"></i>: {{$note->updated_at }}</small>
                           @if ($note->notification == 1)
                              {!! Form::open(array('route' => array('customer.delNotification', $note->customer_id), 'method' => 'PUT')) !!}
                                 {!! Form::hidden('note_id', $note->id) !!}
                                 {!! Form::submit('Usun powiadomienie', array('class'=>'btn btn-xs btn-info'))!!}
                              {!! Form::close()!!}

                           @endif
                        </div>
                        <div class="col-md-2">
                           {!! Form::open(array('route' => array('customer.destroy', $note->customer_id), 'method' => 'DELETE')) !!}
                              {!! Form::hidden('note_id', $note->id) !!}
                              <button class="btn btn-xs btn-danger pull-right" type="submit"><i class="fa fa-times" aria-hidden="true"></i> Usun</button>

                           {!! Form::close()!!}
                        </div>
                     </div>
                  </div>
               </div>

            @endforeach
         </div>
         <div class="panel-footer text-center">
            {{$notes->links()}}
         </div>
      </div>
   </div>
@endsection
