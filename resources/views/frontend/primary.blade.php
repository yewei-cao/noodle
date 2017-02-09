<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-TP8FRR5');</script>
	<!-- End Google Tag Manager -->
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
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TP8FRR5" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
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

<script src="/js/app.js"></script>

<script type="text/javascript">
$('#flash-overlay-modal').modal();
</script>

</body>



</html>