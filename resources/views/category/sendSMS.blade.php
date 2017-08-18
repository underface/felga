@extends('layouts.app')

@section('content')

<div class="container">
	@if(Session::has('message'))
		<div class="alert alert-info alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			{{ Session::get('message') }}
		</div>
	@endif

	<div class="row">
		<div class="col-md-6">
			.
		</div>
		<div class="col-md-6">
		
		</div>
	</div>
</div>
@endsection
