@extends('layouts.app')

@section('content')
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-3">
            <div class="panel panel-default">
               <div class="panel-heading">
                  <h4>Status konta SMS</h4>
               </div>
               <div class="panel-body">
                  @if($smsconnect)
                     <label>Stan konta:</label>
                     <h4>{{$smsbalance/100}} zł</h4>
                     <hr />
                     <label>Smsów do wysłania</label>
                     <h4>{{ round($smsbalance/6)}} zł</h4>
                  @else
                     <h4><label class="label label-warning">Błąd połączania!</label></h4>
                  @endif


               </div>
               <div class="panel-footer">
                  <a href="https://panel.smslabs.net.pl/pl/site/login" class="btn  btn-block btn-info" target="_blank">Przejdź do panelu SMSlabs</a>
               </div>
            </div>
         </div>
         <div class="col-md-9">
            <div class="panel panel-default">
               <div class="panel-heading">
                  <h4>Wysłane SMS</h4>
               </div>

               <div class="panel-body">
                  @if($messages->count() > 0)
                     <div class="table-responsive">
                        <table class="table table-hover table-condensed table-striped">
                           <thead>
                              <tr>
                                 <th>Status</th>
                                 <th>SMS_id</th>
                                 <th>Opis</th>
                                 <th>Wysłał</th>
                                 <th>Klient/<br />Numer</th>
                                 <th>Treść</th>
                                 <th>Data</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($messages as $message)
                                 <tr>
                                    <td>
                                       @if($message->status == 'success')
                                          <button class="btn btn-sm btn-success" title="Sukces"><i class="fa fa-check-circle" aria-hidden="true"></i></button>
                                       @else
                                          <button class="btn btn-sm btn-danger" title="Błąd"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
                                       @endif
                                    </td>
                                    <td>
                                       {{ substr($message->sms_id,0,8) }}<br />
                                       {{ substr($message->sms_id,8,8) }}<br />
                                       {{ substr($message->sms_id,16) }}<br />
                                    </td>
                                    <td>{{ $message->message }}</td>
                                    <td><small>{{ $message->user->name }}</small></td>
                                    <td>{{ $message->customer->name }}<br /><small>{{ $message->customer->number_phone }}</small></td>
                                    <td>
                                       @if($message->status !== 'success')
                                          <label class="label label-default">Brak treści z powodu braku wysyłki</label>
                                       @else
                                          {{ $message->note->content }}
                                       @endif
                                    </td>
                                    <td>
                                       {{ substr($message->created_at,0,10) }}<br />{{ substr($message->created_at,10) }}</td>
                                 </tr>

                              @endforeach
                           </tbody>
                        </table>
                     </div>
                  @else
                     Pusta baza
                  @endif
               </div>
               <div class="panel-footer text-center">
                  {{ $messages->links() }}
               </div>
            </div>
         </div>

      </div>


   </div>
@endsection
