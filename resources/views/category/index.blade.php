@extends('layouts.app')

@section('content')
   <div class="container">
      <div class="panel panel-default">
		<div class="panel-heading">
			<div class="row">
				<div class="col-md-8 col-sm-12">
					<h4>Kategorie</h4>
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
						    		<h4> #{{ $category->name }}</h4>
						    </div>
						    <div class="panel-body">
							    {{  $category->description }}
						    </div>
						    <div class="panel-footer text-center">
							    	<div class="btn-group ">
									<a href="#" class="btn btn-sm btn-info">Edytuj</a>
									<a href="#" class="btn btn-sm btn-primary">Sprawdź</a>
									<a href="#" class="btn btn-sm btn-warning">Inne</a>

							    	</div>
						    </div>

					    </div>

				    </div>
			    @endforeach


		    </div>
         </div>
      </div>
   </div>
@endsection
