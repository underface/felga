@extends('layouts.app')

@section('content')
   <div class="container-fluid">
      <div class="panel panel-success">
         <div class="panel-heading">
            <h3>Dodano klienta!</h3>
         </div>
         <div class="panel-body">

            <h2>{{ $customer->name }}</h2>
            <h3>{{ $customer->number_phone }}</h3>
               <button type="button" class="btn btn-success " data-toggle="modal" data-target=".bs-example-modal-lg">Dodaj Notatkę</button>

               <a href="{{ route('customer.show', ['id' => $customer->id]) }}" class="btn btn-info ">Przejdź do profilu klienta</a>
            <hr />
            <a href="{{ route('customer.create') }}" class="btn btn-primary btn-sm">Dodaj Nowego Klienta</a>
            <a href="{{ route('customer.index') }}" class="btn btn-default btn-sm">Lista Klientów</a>


         </div>
         <div class="panel-footer">

         </div>
      </div>
   </div>



   <div class="modal  bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
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

               <div class="col-md-6">
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

               <div class="col-md-6">
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


@endsection
