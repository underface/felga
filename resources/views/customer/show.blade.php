@extends('layouts.app')

@section('scripts')
   <!-- Bootstrap Date-Picker Plugin -->


<script src='https://cloud.tinymce.com/stable/tinymce.min.js_X'></script>

   <script>
      tinymce.init({
      selector: 'textarea',
      height: 200,
      menubar: false,
      plugins: [
      'advlist autolink lists link charmap',
      'insertdatetime media table contextmenu paste code'
      ],
      toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist',
      content_css: [
      '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
      '//www.tinymce.com/css/codepen.min.css']
      });
   </script>

@endsection

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
                  <h4>Dane Klienta <span class="label label-default">ID: #{{ $customer->id}}</span></h4>
               </div>
               <div class="panel-body">
                  <table>
                     <tbody>
                        <tr>
                           <td><small>Imię i Nazwisko:</small></td>
                           <td><h3>{{ $customer->name}}</h3></td>
                        </tr>
                        <tr>
                           <td><small>Numer Tel:</small></td>
                           <td><h3>{{ $customer->number_phone}}</h3></td>
                        </tr>
                     </tbody>
                  </table>


               </div>
               <div class="panel-footer">
                  <button type="button" class="btn btn-success btn-block btn-sm" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i> Dodaj Notatkę</button>
                  <button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target=".bs-example-modal-smSMS"><i class="fa fa-commenting fa-lg" aria-hidden="true"></i> Wyślij SMSa</button>

                     <!--<a href="#" class="btn btn-warning btn-sm btn-block">Edytuj Dane klienta</a>-->
               </div>
            </div>
         </div>
         <!--Modal do dodawania nowej notatki-->
         <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
           <div class="modal-dialog modal-lg" role="document">
             <div class="modal-content">
               <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title" id="gridSystemModalLabel">Nowa Notatka</h4>
               </div>
               <div class="modal-body">
                  {!! Form::open(array('route' => array('customer.addNote', $customer->id))) !!}
                     {{ Form::hidden('customer_id', $customer->id) }}
                     <div class="form-group">
                        {!! Form::label('title','Tytuł:') !!}
                        {!! Form::text('title',null, array('class'=>'form-control input-lg', 'maxlength'=>'50','placeholder'=>'Tytuł może zostać dodany automatycznie' )) !!}
                     </div>
                     <div class="form-group">
                        {!! Form::label('content','Treść:') !!}
                        {{ Form::textarea('content',null, array('class'=>'form-control', 'required'=>'' )) }}
                     </div>
                     <div class="col-md-6 col-offset-md-2">
                        <div class="btn-group" >
                           {!! Form::label('-','Wybierz typ notatki') !!}
                           <div class="form-group" data-toggle="buttons">
                              <label class="btn btn-primary  active">
                                 <input type="radio" name="notification" id="option_0" value="0" checked>Zwykła Notatka
                              </label>
                              <label class="btn btn-primary">
                                 <input type="radio" name="notification" id="option_1" value="1" > Notatka z przypomnieniem
                              </label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        {!! Form::label('notification_date','Data Przypomnienia: ') !!}
                        <input class="form-control" id="date" name="notification_date"  type="date"  value="{{  date('Y-m-d') }}"  >
                     </div>
                        {!! Form::submit('Zapisz', array('class'=>'btn btn-lg btn-success btn-block')) !!}
                  {!! Form::close() !!}
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Zamknij</button>
               </div>
             </div>
           </div>
         </div>


         <!--Modal do dodawania SMSa-->
         <div class="modal fade bs-example-modal-smSMS" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
               <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title" id="gridSystemModalLabel">Wysyłka SMSa</h4>
               </div>
               <div class="modal-body">
                  {!! Form::open(array('route' => array('customer.sendSMS', $customer->id))) !!}
                     {{ Form::hidden('customer_id', $customer->id) }}
                     <div class="form-group">
                        {!! Form::label('content','Treść wiadomości:') !!}
                        {{ Form::textarea('content',null, array('class'=>'form-control', 'required'=>'', 'rows'=>'3','minlength'=>'20', 'maxlength'=>'160' )) }}
                     </div>
                     <div class="form-group">
                        {!! Form::label('number_phone','Numer telefonu:') !!}
                        {{ Form::text('number_phone',$customer->number_phone, array('class'=>'form-control', 'required'=>'', 'readonly'=>'' )) }}

                     </div>

                        {!! Form::submit('Wyślij wiadomość', array('class'=>'btn btn-lg btn-success btn-block')) !!}
                  {!! Form::close() !!}
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Zamknij</button>
               </div>
            </div>
          </div>
         </div>



<!-- Panel z notatkami-->
         <div class="col-md-9">
            <div class="panel panel-default">
               <div class="panel-heading">
                     <h4>  Notatki
                        <button type="button" class="btn btn-success pull-right btn-sm" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-plus-circle" aria-hidden="true"></i> Dodaj Notatkę</button>
                     </h4>


               </div>
               <div class="panel-body">

                  @foreach ($notes as $note)

                  <div class="panel
                     @if ($note->notification == 1)
                        panel-danger
                     @else
                        panel-default
                     @endif
                   panel-note">
                     <div class="panel-heading">
                        <h5><span class="label label-default">ID: #{{ $note->id}}</span> {{$note->title }}</h5>
                     </div>
                     <div class="panel-body">
                        {{ $note->content }}

                        @if ($note->notification == 1)
                           <br/><span class="label label-danger"><i class="fa fa-bell" aria-hidden="true"></i> Powiadomienie! <i class="fa fa-clock-o" aria-hidden="true"></i>  {{ $note->notification_date }}</span>
                        @endif
                     </div>
                     <div class="panel-footer">
                        <div class="row">
                           <div class="col-md-10">
                              <small><i class="fa fa-at" aria-hidden="true"></i>{{ $note->user->name}} <i class="fa fa-calendar-o" aria-hidden="true"></i>: {{ $note->created_at }} <i class="fa fa-calendar-check-o" aria-hidden="true"></i>: {{$note->updated_at }}</small>
                              @if ($note->notification == 1)
                                 {!! Form::open(array('route' => array('customer.delNotification', $customer->id), 'method' => 'PUT')) !!}
                                    {!! Form::hidden('note_id', $note->id) !!}
                                    <button class="btn btn-xs btn-info" type="submit"><i class="fa fa-times" aria-hidden="true"></i> Usuń powiadomienie</button>
                                 {!! Form::close()!!}

                              @endif
                           </div>
                           <div class="col-md-2">
                              {!! Form::open(array('route' => array('customer.destroy', $customer->id), 'method' => 'DELETE')) !!}
                                 {!! Form::hidden('note_id', $note->id) !!}
                                 <button class="btn btn-xs btn-danger pull-right" type="submit"><i class="fa fa-times" aria-hidden="true"></i> Usuń notatkę</button>
                              {!! Form::close()!!}
                           </div>
                        </div>
                     </div>
                  </div>
                  @endforeach

               </div>
               <div class="panel-footer text-center">
                  {!! $notes->links(); !!}
               </div>
            </div>
         </div>
      </div>








   </div>
@endsection