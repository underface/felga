@extends('layouts.app')

@section('content')
   <div class="container">
      <div class="panel panel-default">
         <div class="panel-heading">
            <h3>Panel Zarządzania Użytkownikami</h3>
         </div>
         <div class="panel-body">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Nowy Użytkownik</a>
            <hr />

         </div>
         <div class="panel-footer">

         </div>
      </div>
   </div>
@endsection
