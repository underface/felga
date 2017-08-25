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
         <div class="col-md-3">
            <div class="panel panel-default">
               <div class="panel-heading">
                  <h4>Dane Klienta <span class="label label-default">ID: #{{ $customer->id}}</span></h4>
               </div>
               <div class="panel-body">
				<label><small>Imię i Nazwisko:</small></label>
				<h4>{{ $customer->name}}</h4>
				<label><small>Numer telefonu:</label>
				<h4>{{ $customer->number_phone}}</h4>
				<label><small>email:</label>
				<h4>{{ $customer->email}}</h4><hr />
				Dodano: {{ $customer->created_at}}<br />
				przez:  {{ $customer->user->name }}



               </div>
			<div class="panel-footer">
				{!! Form::open(array('route' => 'customer.add_category')) !!}
					{{ Form::hidden('customer_id', $customer->id) }}
					@if(count($categories))
						<div class="form-group">
							<label><i class="fa fa-tags" aria-hidden="true"></i> Wybierz kategorię:</label><br />

							@foreach ($categories as $category)
								<label class="btn-block btn btn-sm btn-default" > <input  type="checkbox" name="categories[]" value="{{$category->id}}"
									@foreach ($customer->categories as $check_category)
										@if ($check_category->id == $category->id)
											checked
										@endif
									@endforeach
									/> {{$category->name}}</label>
							@endforeach

						</div>
					@endif

	               {!! Form::submit('Edytuj Kategorie', array('class'=>'btn btn-primary btn-block','style'=>'margin:5px 0 5px 0')) !!}
	               {!! Form::close() !!}

               </div>
               <div class="panel-body	">
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
                              <label class="btn btn-default  active">
                                 <input type="radio" name="notification" id="option_0" value="0" checked><i class="fa fa-commenting" aria-hidden="true"></i> Zwykła Notatka
                              </label>
                              <label class="btn btn-danger">
                                 <input type="radio" name="notification" id="option_1" value="1" ><i class="fa fa-bell" aria-hidden="true"></i> Notatka z przypomnieniem
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
                        {{ Form::textarea('content',null, array('class'=>'form-control', 'required'=>'', 'rows'=>'3','minlength'=>'20', 'maxlength'=>'160','id'=>'content_sms' )) }}
								<span class="label label-info"><span id="HowMany">0</span> znaków.</span>
								<span class="label label-warning">1 SMS to max 160 znaków.</span>
                     </div>
                     <div class="form-group">
                        {!! Form::label('number_phone','Numer telefonu:') !!}
                        {{ Form::text('number_phone',$customer->number_phone, array('class'=>'form-control', 'required'=>'', 'readonly'=>'' )) }}

                     </div>
                        {!! Form::submit('Wyślij wiadomość', array('class'=>'btn btn-lg btn-success btn-block')) !!}
                  {!! Form::close() !!}
               </div>



               <div class="modal-footer">
                  <button type="button" class="btn btn-warning pull-left"  ata-dismiss="modal">Zamknij</button>
               </div>
            </div>
          </div>
         </div>




<!-- Panel z notatkami-->
         <div class="col-md-9">

		    @if(count($customer->categories))
			    <div class="panel panel-default">
			    		<div class="panel-body">Kategorie:
			    			@foreach ($customer->categories as $category)
							<button class="btn btn-primary">#{{ $category->name }}</button>

			    			@endforeach
			    		</div>
			    </div>
	    		@endif


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
                        <h5>{{ $note->content }}</h5>

                        @if ($note->notification == 1)
                           <br/><span class="label label-danger"><i class="fa fa-bell" aria-hidden="true"></i> Powiadomienie! <i class="fa fa-clock-o" aria-hidden="true"></i>  {{ $note->notification_date }}</span>
                        @endif
                     </div>
                     <div class="panel-footer">
                        <div class="row">
                           <div class="col-md-10">
                              <small><i class="fa fa-at" aria-hidden="true"></i>{{ $note->user->name}} <i class="fa fa-calendar-o" aria-hidden="true"></i>: {{ $note->created_at }}</small>
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
@section('scripts')

	<script>
	$("#content_sms").on("input", function() {
	 $("#HowMany").text(this.value.length);

	});
	</script>

@endsection
