@extends('layouts.app')

@section('content')
<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4>Dodawanie Notatki</h4>
		</div>
		<div class="panel-body">
			@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			@if(Session::has('message'))
			   <div class="alert alert-info alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				{{ Session::get('message') }}
			   </div>
			@endif
			@if(Session::has('message2'))
			   <div class="alert alert-info alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				{{ Session::get('message2') }} Jeśli chcesz przejdź do profilu klienta <a href="{{ route('customer.show', Session::get('customer_id')) }}" class="btn btn-info btn-sm">Przejdź</a>
			   </div>
			@endif


			{!! Form::open(array('route' => 'note.store')) !!}
				<div class="row">
					<div class="col-md-6">
						<div class="form-group ">
							<label for="number_phone">Numer Telefonu</label>
							<div class="input-group">
								<input type="text" class="form-control" id="number_phone" name="number_phone" minlength="9" maxlength="9" placeholder="Wpisz numer telefonu aby wyszukać klienta"
								@isset($customer->number_phone)
								value = "{{ $customer->number_phone }} - {{ $customer->name }}" readonly
								@endisset
								>
								<div class="input-group-btn">
									<button class="btn btn-info col-md-12 col-sm-12 col-xs-12" name="submitbutton" value="check"
										@isset($customer->number_phone)
										value = "{{ $customer->number_phone }}" disabled
										@endisset
										>
										<i class="fa fa-search fa-lg" aria-hidden="true"></i> Sprawdź
									</button>
								</div>
							</div>
						</div>
						<!-- Input jeśli nie znaleziono klienta-->
						<div class="form-group ">
							<label for="name">Imię i nazwisko:</label>
							<input type="text" class="form-control" id="name" name="name" placeholder="Wpisz Imię i nazwisko" style="text-transform:uppercase"
								@isset($customer->number_phone)
								value = "{{ $customer->name }}" disabled
								@endisset
							>
							@isset($customer->number_phone)
								<input type="hidden" name="customer_id" value = "{{ $customer->id }}" />
							@endisset
						</div>
					</div>
					<!-- end left side - search-->
					<div class="col-md-6">
						@if(count($categories))
							<div class="form-group">
								{!! Form::label('categories', 'Wybierz kategorię:') !!}
								@foreach ($categories as $category)
									<label class="form-control"><input  type="checkbox" name="categories[]" value="{{$category->id}}" /> {{$category->name}}</label>
								@endforeach
							</div>
						@endif
					</div>
				</div>
				<!-- end right side - categories-->
				<hr />
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<div class="form-group">
							{!! Form::label('content','Treść:') !!}
							{{ Form::textarea('content',null, array('class'=>'form-control', 'rows'=>'3' )) }}
						</div>
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
						<div class="col-md-4">
							{!! Form::label('notification_date','Data Przypomnienia: ') !!}
							<input class="form-control" id="date" name="notification_date"  type="date"  value="{{  date('Y-m-d') }}"  >
						</div>
						<div class="form-group">
							<button class="btn btn-success btn-block" name="submitbutton" value="save">
								<i class="fa fa-floppy-o" aria-hidden="true"></i> Zapisz
							</button>
						</div>
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection
