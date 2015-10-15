<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>
	<link href="/css/frontend/frontend.css" rel="stylesheet" type= "text/css" />
	
	@yield('css.style')

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<![endif]-->
	<script src="/js/libs.js"></script>
	@yield('jscript')
	
</head>
<body>
	
	@include('frontend.includes.nav')
	
	<div class= "container">
	
	 @include('flash::message') 
	
	@yield('content')
	</div>
		
	<div class="flash">
		Updated!
	</div>

<!-- @include('partials.sweetflash') -->

@yield('scripts.footer')

</body>

<script src="/js/app.js"></script>

<script type="text/javascript">
$('#flash-overlay-modal').modal();
</script>

</html>