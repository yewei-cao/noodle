@extends('frontend.master')

@section('title')
	{!! $shop->title.trans('front_title.title') !!}
@endsection

@section('meta')
	{!! $shop->meta !!}
@endsection

@section('css.style')
<style>

</style>
@endsection

@section('content')

<div id="theCarousel" class="carousel slide" data-ride="carousel">
<ol class="carousel-indicators">
<li data-tagret="#theCarousel" data-slide-to="0" class="active"></li>
<li data-tagret="#theCarousel" data-slide-to="1" ></li>
</ol>

<div class="carousel-inner">
	<div class="item active">
		<div class="slidel1"></div>
		<div class="carousel-caption">
		</div>
	</div>
	
	<div class="item">
		<div class="slidel2"></div>
		<div class="carousel-caption">
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
<a id="quick" href="{{ route('menu.index') }}" class="myservice red" >

<div class="service-icon">
<img class="img-circle" width="140" height="140" alt="Generic placeholder image" src="images/home/home_quickorder.png">
</div>
<div class="service-text">

<h2>Menu</h2>
<p>Fresh Healthy Cook-Arts</p>

<!-- <h2>{{ trans('front_home.quick_order') }}</h2> -->
<!-- <p>{{ trans('front_home.quick_order_ext') }}</p> -->
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
