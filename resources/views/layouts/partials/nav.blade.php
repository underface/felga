<nav class="navbar navbar-default navbar-static-top navbar-fixed-top">
    <div class="container">
	   <div class="navbar-header">

		  <!-- Collapsed Hamburger -->
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
			 <span class="sr-only">Toggle Navigation</span>
			 <span class="icon-bar"></span>
			 <span class="icon-bar"></span>
			 <span class="icon-bar"></span>
		  </button>

		  <!-- Branding Image -->
		  <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }} </a>
	   </div>

	   <div class="collapse navbar-collapse" id="app-navbar-collapse">
		  <!-- Left Side Of Navbar -->
		  <ul class="nav navbar-nav">
			 &nbsp;
		  </ul>

		  <!-- Right Side Of Navbar -->
		  <ul class="nav navbar-nav navbar-right">
			 <!-- Authentication Links -->
			 @if (Auth::guest())
			     <li><a href="{{ route('login') }}">Login</a></li>

			 @else


			    <!--Dropdowno Powiadomienia-->
			    <li class="dropdown">
			     <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
			    	 <i class="fa fa-bell" aria-hidden="true"></i> 
					 @if ( $notification_count > 0)
						  <span class="label label-danger">{{ $notification_count }}</span>
					 @else
						  <span class="label label-default">0</span>
					 @endif
					 <span class="caret"></span>
			     </a>

					<ul class="dropdown-menu" role="menu">
						<li><a href="{{ route('note.notification', 'old') }}">Powiadomienia po terminie <i class="fa fa-bell" aria-hidden="true"></i><span class="label label-danger">{{ $notification_old }}</span></a></li>
						<li role="separator" class="divider"></li>
						<li><a href="{{ route('note.notification', 'today') }}">Powiadomienia na dziś <i class="fa fa-bell" aria-hidden="true"></i><span class="label label-warning">{{ $notification_today }}</span></a></li>
						<li role="separator" class="divider"></li>
						<li><a href="{{ route('note.notification', 'future') }}">Powodomienia w przyszłości <i class="fa fa-bell" aria-hidden="true"></i><span class="label label-default">{{ $notification_future }}</span></a></li>
						<li role="separator" class="divider"></li>
						<li><a href="{{ route('note.notification') }}">Wszystkie powiadomienia <i class="fa fa-bell" aria-hidden="true"></i><span class="label label-default">{{ $notification_all }}</span></a></li>
					</ul>
			    </li>

				    <!--Dropdowno Notatki-->
				    <li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						<i class="fa fa-sticky-note-o" aria-hidden="true"></i> Notatki  <span class="caret"></span>
					</a>

					<ul class="dropdown-menu" role="menu">
						<li><a href="{{ route('note.index') }}"><i class="fa fa-sticky-note" aria-hidden="true"></i> Lista Notatek</a></li><li role="separator" class="divider"></li>
						<li><a href="{{ route('note.create') }}"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Dodaj Notatkę</a></li><li role="separator" class="divider"></li>
						<li><a href="{{ route('note.notification') }}"><i class="fa fa-bell" aria-hidden="true"></i> Powiadomienia</a></li><li role="separator" class="divider"></li>
						<!--<li><a href="#"><i class="fa fa-search" aria-hidden="true"></i> Szukaj</a></li>-->
					</ul>
				    </li>

					<!--Dropdowno Klienci-->
				    <li class="dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						 <i class="fa fa-users" aria-hidden="true"></i> Klienci  <span class="caret"></span>
					  </a>

					  <ul class="dropdown-menu" role="menu">
						 <li><a href="{{ route('customer.index') }}"><i class="fa fa-list-ul" aria-hidden="true"></i> Lista Klientów</a></li><li role="separator" class="divider"></li>
						 <li><a href="{{ route('customer.create') }}"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Dodaj Klienta</a></li><li role="separator" class="divider"></li>
						 <li><a href="{{ route('customer.searchbox') }}"><i class="fa fa-search" aria-hidden="true"></i> Szukaj</a></li>
					  </ul>
				    </li>

				    <!--Dropdowno Klienci-->
				   <li class="dropdown">
					 <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						<i class="fa fa-tags" aria-hidden="true"></i> Kategorie  <span class="caret"></span>
					 </a>

					 <ul class="dropdown-menu" role="menu">
						<li><a href="{{ route('category.index') }}"><i class="fa fa-tags" aria-hidden="true"></i> Lista Kategorii</a></li><li role="separator" class="divider"></li>
						<li><a href="{{ route('category.create') }}"><i class="fa fa-tag" aria-hidden="true"></i> Dodaj Nową kategorię</a></li>

					 </ul>
				   </li>

					@role('superadministrator|administrator')
						<li><a href="{{ route('admin.index')}}"><i class="fa fa-bars" aria-hidden="true"></i> Panel {{Auth::user()->name}}</a></li>
					@endrole




			     <li class="dropdown">
				    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
					   {{ Auth::user()->name }}  <span class="caret"></span>
				    </a>

				    <ul class="dropdown-menu" role="menu">
					   <li><a href="{{ route('manage.profil')}}"><i class="fa fa-bars" aria-hidden="true"></i> Mój Profil: {{ Auth::user()->name }}</a></li>
						<li role="separator" class="divider"></li>
					   <li>
						<a> <i class="fa fa-usd" aria-hidden="true"></i> 	Balans konta SMS<br />
							<span class="label label-default">{{ $smsbalance/100}}</b> zł. (tj. {{ round($smsbalance/6) }} SMS)</span>
						</a>
					   </li><li role="separator" class="divider"></li>
					   <li>
						  <a href="{{ route('logout') }}"
							 onclick="event.preventDefault();
									document.getElementById('logout-form').submit();">
							 Wyloguj
						  </a>

						  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

							 {{ csrf_field() }}
						  </form>
					   </li>
				    </ul>
			     </li>
			 @endif
		  </ul>
	   </div>
    </div>
</nav>
