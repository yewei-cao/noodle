@extends('frontend.master')

@section('css.style')

<style>

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
			<h1>Something1</h1>
			<p>Thousands of Backgrounds for Free</p>
			<p><a href="#" class="btn btn-primary btn-sm" >Get them Now</a></p>
		</div>
	</div>
	
	<div class="item">
		<div class="slidel2"></div>
		<div class="carousel-caption">
			<h1>Something22</h1>
			<p>Thousands of Backgrounds for Free</p>
			<p><a href="#" class="btn btn-primary btn-sm" >Get them Now</a></p>
		</div>
	</div>
	
	
	<div class="item">
		<div class="slidel3"></div>
		<div class="carousel-caption">
			<h1>Something333</h1>
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

<div class="col-4">
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



<div class="col-4">
<a id="quick" href="{{ route('home.delivery.info') }}" class="myservice red" >

<div class="service-icon">
<img class="img-circle" width="140" height="140" alt="Generic placeholder image" src="images/home/delivery_food.png">
</div>
<div class="service-text">
<h2>{{ trans('front_home.delivery') }}</h2>
<p>{{ trans('front_home.delivery_ext') }}</p>

</div>
</a>
</div>


<div class="col-4">
<a id="quick" href="{{ route('home.pickup.info') }}" class="myservice red" >

<div class="service-icon">
<img class="img-circle" width="140" height="140" alt="Generic placeholder image" src="images/home/noodle_pickup.png">
</div>
<div class="service-text">
<h2>{{ trans('front_home.pick_up') }}</h2>
<p>{{ trans('front_home.pick_up_ext') }}</p>
</div>
</a>
</div>


</div>

@endsection
