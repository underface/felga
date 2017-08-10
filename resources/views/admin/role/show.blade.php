@extends('layouts.app')

@section('content')
	<div class="container">

@if(Session::has('message'))
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-success" role="alert">
						{{ Session::get('message') }}
				</div>
			</div>
		</div>
@endif

		@include('admin.menu')


	<div class="col-md-9">
		<div class="panel panel-default">
			<div class="panel-heading"><h4>Rola: <b>{{$role->display_name}}</b> <small>{{$role->name}}</small></h4></div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6">
						<h4>Uprawienia</h4>
						<hr />
							<form action="{{route('admin.role.edit',$role->id)}}" method="POST">
								<input name="_method" type="hidden" value="PUT">
								 {{ csrf_field() }}

								@foreach ($permissions as $permission)
									<label><input type="checkbox" name="permission[]" value="{{$permission->id}}"
										@foreach ($role->permissions as $p)
											@if ($p->id == $permission->id)
												checked
											@endif
										@endforeach
										/> {{$permission->display_name}}</label><br />
								@endforeach
								<hr />
								<input type="submit" class="btn btn-block btn-primary" value="Zaktualizuj" />
							</form>
					</div>
					<div class="col-md-6">
						<h4>Użytkownicy z tą rolą:</h4><hr />
						<ul>
							@foreach ($role->users as $user)
								<li>{{$user->name}}</li>
							@endforeach
						</ul>
					</div>
				</div>

			</div>
		</div>

	</div>
</div>
@endsection
