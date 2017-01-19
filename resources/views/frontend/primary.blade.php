<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	@yield('meta')
	<title>
	@yield('title')
	</title>
	
	<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" >
	<link href="/css/frontend/frontend.css" rel="stylesheet" type= "text/css" />
	
	@yield('css.style')

	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<![endif]-->
	<script src="/js/libs.js"></script>
	@yield('jscript')
	
</head>
<body>
	<div id="wrap">
		@include('frontend.includes.frontnav')
		
		<div class= "container minheiht">
			@include('flash::message') 
			@yield('content')
		</div>
			
		<div class="flash">
		</div>
	
	</div>

<!-- @include('partials.sweetflash') -->

	@include('frontend.includes.footer')
	
@yield('scripts.footer')



</body>

<script src="/js/app.js"></script>

<script type="text/javascript">
$('#flash-overlay-modal').modal();
</script>

</html>