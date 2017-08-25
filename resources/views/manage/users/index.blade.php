
@extends('layouts.app')

@section('content')
   <div class="container-fluid">
      <div class="panel panel-default">
         <div class="panel-heading">
            <h3>Użytkownicy</h3>
         </div>

         <div class="panel-body">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Nowy Użytkownik</a>
            <hr />
		  <div class="row">


			  @foreach ($users as $user)
				  <div class="col-md-3">
					  <div class="panel panel-default">
						  <div class="panel-heading">
							<h4>{{ $user->name }} <small><br />{{$user->email}}</small></h4>

						  </div>
						  <div class="panel-body">
							<h4>Role:</h4>
							<ul>

								@foreach ($user->roles as $role)
									<li>{{$role->display_name}} <small>({{ $role->name }})</small>
									</li>
								@endforeach
							</ul>
								<hr />
							<h5>Uprawnienia:</h5>
							<ul>
								@foreach ($user->permissions as $permission)
									<li>{{$permission->display_name}} <small>({{ $permission->name }})</small>
									</li>
								@endforeach
							</ul>
						  </div>

					  </div>
				  </div>

			  @endforeach
		  </div>
         </div>
         <div class="panel-footer">

         </div>
      </div>
   </div>
@endsection
