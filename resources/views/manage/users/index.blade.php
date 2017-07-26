
@extends('layouts.app')

@section('content')
   <div class="container">
      <div class="panel panel-default">
         <div class="panel-heading">
            <h3>Użytkownicy</h3>
         </div>

         <div class="panel-body">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Nowy Użytkownik</a>
            <hr />

		  @foreach ($users as $user)
			  <div class="panel panel-default">
				  <div class="panel-heading">
					<h4>{{ $user->name }} <small>{{$user->email}}</small></h4>

				  </div>
				  <div class="panel-body">
					<h5>Uprawnienia:</h5>
					<ul>

						@foreach ($user->roles as $role)
							<li>{{$role->display_name}} <small>({{ $role->name }})</small></li>
						@endforeach
					</ul>
				  </div>

			  </div>
		  @endforeach
         </div>
         <div class="panel-footer">

         </div>
      </div>
   </div>
@endsection
