@extends('frontend.master')


@section('css.style')

<style>

/* Carousel Styling */
.slidel1{
background-image:url('images/ad/satay.jpg');
height: 300px;
background-repeat: no-repeat;
background-position: center;
background-size: cover;
}

.slidel2{
background-image:url('images/ad/sweet-box.jpg');
height: 300px;
background-repeat: no-repeat;
background-position: center;
background-size: cover;
}

.slidel3{
background-image:url('images/ad/garlic-prawns.jpg');
height: 300px;
background-repeat: no-repeat;
background-position: center;
background-size: cover;
}

.carousel-caption h1{
font-size: 5.4em;
font-family: 'Pacifico', cursive;
padding-bottom: .4em;
}

.carousel-caption p{
font-size: 2em;
}


</style>

@endsection

@section('content')


<div id="theCarousel" class="carousel slide" data-ride="carousel">
<ol class="carousel-indicators">
<li data-tagret="#theCarousel" data-slide-to="0" class="active"></li>
<li data-tagret="#theCarousel" data-slide-to="1" ></li>
<li data-tagret="#theCarousel" data-slide-to="2" "></li>
</ol>

<div class="carousel-inner">
	<div class="item active">
		<div class="slidel1"></div>
		<div class="carousel-caption">
			<h1>AD1</h1>
			<p>Thousands of Backgrounds for Free</p>
			<p><a href="#" class="btn btn-primary btn-sm" >Get them Now</a></p>
		</div>
	</div>
	
	<div class="item">
		<div class="slidel2"></div>
		<div class="carousel-caption">
			<h1>ADs2222222</h1>
			<p>Thousands of Backgrounds for Free</p>
			<p><a href="#" class="btn btn-primary btn-sm" >Get them Now</a></p>
		</div>
	</div>
	
	
	<div class="item">
		<div class="slidel3"></div>
		<div class="carousel-caption">
			<h1>ADs333333333</h1>
			<p>Thousands of Backgrounds for Free</p>
			<p><a href="#" class="btn btn-primary btn-sm" >Get them Now</a></p>
		</div>
	</div>




</div>

<a class="left carousel-control" href="#theCarousel" data-slide="prev">
<span class="glyphicon glyphicon-chevron-left"></span>
</a>

<a class="right carousel-control" href="#theCarousel" data-slide="next">
<span class="glyphicon glyphicon-chevron-right"></span>
</a>

</div>



<div class="starter text-center">
<h1>{{ trans('front_home.home_to_start_order') }}</h1>
</div>



<div id="myservice-container">

<div class=" col-md-4">
<a id="quick" href="#" class="myservice red" >

<div class="service-icon">
<img class="img-circle" width="140" height="140" alt="Generic placeholder image" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==">
</div>
<div class="service-text">
<h2>{{ trans('front_home.quick_order') }}</h2>
<p>{{ trans('front_home.quick_order_ext') }}</p>
</div>
</a>
</div>



<div class="col-md-4">
<a id="quick" href="/eStore/en/QuickOrder " class="myservice red" >

<div class="service-icon">
<img class="img-circle" width="140" height="140" alt="Generic placeholder image" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==">
</div>
<div class="service-text">
<h2>{{ trans('front_home.delivery') }}</h2>
<p>{{ trans('front_home.delivery_ext') }}</p>

</div>
</a>
</div>


<div class=" col-md-4">
<a id="quick" href="{{ route('home.pickup') }}" class="myservice red" >

<div class="service-icon">
<img class="img-circle" width="140" height="140" alt="Generic placeholder image" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==">
</div>
<div class="service-text">
<h2>{{ trans('front_home.pick_up') }}</h2>
<p>{{ trans('front_home.pick_up_ext') }}</p>
</div>
</a>
</div>


</div>

@endsection
