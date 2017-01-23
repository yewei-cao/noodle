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

<div class="col-md-12">

<div class="col-md-4">
	<div class="home_detail">
		<h2 class="text-center">About Us</h2>
		<hr>
		<p>Located at 269 Gloucester St, Noodle Canteen – Taradale serves an appetizing mix of Asian Cuisine. Everything is prepared fresh by our Asian chefs and include choice dishes, such as Seafood Mee Goreng, Nasi Goreng, Chicken Fried Rice and many more.</p>
	</div>
</div>

<div class="col-md-4">
	<div class="home_detail">
		<a href="{{ route('menu.index') }}">
			<h2 class="text-center">Menu</h2>
			<hr>
			<p>You can have your food delivered or avail of our takeaway service from Tuesday to Sundays. An extensive selection of popular noodles will excite your palate. Soups and Fried Rice are also included in the menu.</p>
		</a>
	</div>
</div>

<div class="col-md-4">
	<div class="home_detail">
		<h2 class="text-center">Opening Hours</h2>
		<hr>
		
		<div class="open_detail">
			<span class="day-name">Monday</span>
			<span class="day-time">
				<span class="opentime">day off</span>
			</span>
		</div>
		
		<div class="open_detail">
			<span class="day-name">Tuesday</span>
			<span class="day-time">
				<span class="opentime">11:00</span> to <span class="opentime">21:00</span>
			</span>
		</div>
		
		<div class="open_detail">
			<span class="day-name">Wednesday</span>
			<span class="day-time">
				<span class="opentime">11:00</span> to <span class="opentime">21:00</span>
			</span>
		</div>
		
		<div class="open_detail">	
			<span class="day-name">Thursday</span>
			<span class="day-time">
				<span class="opentime">11:00</span> to <span class="opentime">21:00</span>
			</span>
		</div>
		
		<div class="open_detail">
			<span class="day-name">Friday</span>
			<span class="day-time">
				<span class="opentime">11:00</span> to <span class="opentime">21:00</span>
			</span>
		</div>	
			
		<div class="open_detail">
			<span class="day-name">Saturday</span>
			<span class="day-time">
				<span class="opentime">11:00</span> to <span class="opentime">21:00</span>
			</span>
		</div>
			
		<div class="open_detail">
			<span class="day-name">Sunday</span>
			<span class="day-time">
				<span class="opentime">11:00</span> to <span class="opentime">21:00</span>
			</span>
		</div>
			
	</div>
</div>

</div>


<div class="starter text-center">
<h1>{{ trans('front_home.home_to_start_order') }}</h1>
</div>


<div id="myservice-container">

<div class="col-4">
<a id="quick" href="{{ route('home.quickorder') }}" class="myservice red" >
<div class="service-icon">
<img class="img-circle" width="140" height="140" alt="Generic placeholder image" src="images/home/home_quickorder.png">
</div>
<div class="service-text">

<!-- <h2>Menu</h2> -->
<!-- <p>Fresh Healthy Cook-Arts</p> -->

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

<div class="col-md-12">
<h2>Our Location</h2>
<hr>
<p>269 Gloucester St, Noodle Canteen – Taradale Ph: (06) 844 3588</p>
	<div class="googlemap">
		{!! Mapper::render() !!}
	</div>

</div>


@endsection
