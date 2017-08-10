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
			<div class="panel-heading"><h4>Role dostępu</h4></div>
			<div class="panel-body">

				@foreach ($roles as $role)
					<div class="col-md-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4>
									{{$role -> display_name}}<br />
									<small>{{$role->name}}</small>
								</h4>
							</div>
							<div class="panel-body">
								{{$role->description}}
							</div>
							<div class="panel-footer">
								<a href="{{ route('admin.role.show', $role->id) }}" class="btn btn-block btn-sm btn-default">Uprawnienia</a>
							</div>
						</div>
				</div>

				@endforeach
			</div>
		</div>

	</div>
</div>
@endsection
