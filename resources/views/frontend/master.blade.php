<!DOCTYPE html>
<html lang="en">
<head>
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-91080442-1', 'auto');
  ga('send', 'pageview');

</script>
	
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
	<div id="home_wrap">
		@include('frontend.includes.nav')
		
		<div class= "container minheiht">
			@include('flash::message') 
			@yield('content')
		</div>
			
		
	</div>

<!-- @include('partials.sweetflash') -->
@include('frontend.includes.footer')

@yield('scripts.footer')
<script src="/js/app.js"></script>

<script type="text/javascript">
$('#flash-overlay-modal').modal();
</script>

</body>


</html>