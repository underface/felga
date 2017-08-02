@extends('layouts.app')

@section('content')
   <div class="container">
      <div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<div class="col-md-8 col-sm-12">
					<h3><i class="fa fa-tags" aria-hidden="true"></i> Kategorie</h3>
				</div>
				<div class="col-md-4 col-sm-12">
					<a href="{{ route('category.create') }}" class="btn btn-success  pull-right"><i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i> Dodaj nową kategorię</a>
				</div>
			</div>
		</div>


		<div class="panel-body">

		</div>
         <div class="panel-body">
		    <div class="row">
			    @foreach ($categories as $category)
				    <div class="col-md-4">
					    <div class="panel panel-default">
						    <div class="panel-heading">
						    		<h4><a href="{{ route('category.show',$category->id )}}" ><i class="fa fa-tag" aria-hidden="true"></i> {{ $category->name }}</a></h4>
						    </div>
						    <div class="panel-body">
							    {{  $category->description }}
						    </div>
						    <div class="panel-footer text-center">
						    		Zainteresowanych klientów: <strong><i class="fa fa-user" aria-hidden="true"></i> {{ $category->customers()->count() }}</strong>
						    </div>
						    <div class="panel-footer text-center">
						    		<a href="{{ route('category.show',$category->id )}}" class="btn btn-sm btn-primary btn-block"><i class="fa fa-chevron-circle-right fa-lg" aria-hidden="true"></i> Sprawdź klientów</a>
						    </div>

					    </div>

				    </div>
			    @endforeach


		    </div>
         </div>
      </div>
   </div>
@endsection
