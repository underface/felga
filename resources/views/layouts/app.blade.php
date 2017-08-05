<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
	 <link href="{{ asset('css/loader.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

    @yield('scripts')

    <script type="text/javascript">
        window.smartlook||(function(d) {
        var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
        var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
        c.charset='utf-8';c.src='https://rec.smartlook.com/recorder.js';h.appendChild(c);
        })(document);
        smartlook('init', 'cd54698aa0ba1c9b5bfc6520ee84519807c24aff');
    </script>


</head>
<body>
<div id="loader-wrapper">
    <div class="load">
      <hr/><hr/><hr/><hr/>
    </div>
	 </div>
    <div id="app">


	   @include('layouts.partials.nav')


        @yield('content')
    </div>


    <!-- Scripts -->
   <script src="{{ asset('js/app.js') }}"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script>
	$('html').addClass('js');

	$(window).load(function() {
	    setTimeout(
	      function()
	      {
	          $("#loader-wrapper").fadeOut();
	      });
	});
	</script>

</body>
</html>
