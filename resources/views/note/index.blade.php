@extends('layouts.app')

@section('content')
   <div class="container-fluid">
      <div class="panel panel-default">
         <div class="panel-heading">
            <div class="row">
               <div class="col-md-9">
                  <h3>Notatki</h3>
               </div>
               <div class="col-md-3">
                  <a href="{{ route('note.create') }}" class="btn btn-primary pull-right "><i class="fa fa-plus-circle" aria-hidden="true"></i> Nowa Notatka</a>
               </div>
            </div>
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
                  <div class="row">
                     <div class="col-md-8">
                        <h5><span class="label label-default">ID: #{{ $note->id}}</span> {{$note->title }}</h5>
                     </div>
                     <div class="col-md-4">
                        <div class="btn-toolbar pull-right" role="toolbar" aria-label="">
                           @if ($note->notification == 1)
                              <button class="btn btn-xs btn-danger"><i class="fa fa-bell" aria-hidden="true"></i> Powiadomienie! <i class="fa fa-clock-o" aria-hidden="true"></i>  {{ $note->notification_date }}</button>
                              <a href="{{ route('customer.delNotification',$note->customer_id) }}" onclick="event.preventDefault();
                                 document.getElementById('form-delNotification-{{$note->id}}').submit();" class="btn btn-xs btn-info"><i class="fa fa-times" aria-hidden="true"></i> Usuń powiadomienie</a>

                              <form id="form-delNotification-{{$note->id}}" action="{{ route('customer.delNotification',$note->customer_id) }}"
                                 method="POST" style="dispay:none;">
                                 {{ csrf_field() }}
                                 <input type="hidden" name="_method" value="PUT" />
                                 {!! Form::hidden('note_id', $note->id) !!}
                              </form>

                           @endif
                        </div>
                     </div>
                  </div>
               </div>
                  <div class="panel-body">

                     <blockquote>
                        {{ $note->content }}
                        <footer>
                           Dodał: {{ $note->user->name}} | {{ $note->created_at }}
                        </footer>
                     </blockquote>


                     <a href="{{ route('customer.show', $note->customer_id) }}" class="btn btn-sm btn-default"><small><i class="fa fa-user" aria-hidden="true"></i>: {{ $note->customer->name }}</small></a>
                     @if($note->customer->checked == 0)
                        <a href="{{ route('customer.checked', $note->customer_id) }}" class="btn btn-sm btn-success"><i class="fa fa-check-square" aria-hidden="true"></i></a>
                     @endif
                     {!! Form::open(array('route' => array('customer.destroy', $note->customer_id), 'method' => 'DELETE')) !!}
                        {!! Form::hidden('note_id', $note->id) !!}
                        <button class="btn btn-xs btn-danger pull-right" type="submit"><i class="fa fa-times" aria-hidden="true"></i> Usun</button>
                     {!! Form::close()!!}
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
