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
		<p>Located at 269 Gloucester St, Noodle Canteen Taradale serves an appetizing mix of Asian Cuisine. Everything is prepared fresh by our Asian chefs and include choice dishes, such as Seafood Mee Goreng, Nasi Goreng, Chicken Fried Rice and many more.</p>
	</div>
</div>

<div class="col-md-4">
	<div class="home_detail">
		<a href="{{ route('menu.index') }}">
			<h2 class="text-center">Menu</h2>
			<hr>
			<p>You can have your food delivered or takeaway from Tuesday to Sunday. An extensive selection of popular noodles will excite your palate. Soups and Fried Rice are also included in the menu.</p>
		</a>
	</div>
</div>

<div class="col-md-4">
	<div class="home_detail">
		{!! $shop->openhours !!}
	</div>
</div>

</div>

<!-- <div class="starter text-center"> -->
<!-- <h3>Following the government’s announcement regarding Level 4 Lockdown, Noodle Canteen will be closed from Tuesday, 24 March until further notice..</h3> -->
<!-- </div> -->

<div class="starter text-center">
{!! $shop->showtext !!}
</div>


<div id="myservice-container">

<!-- missing quick and delivery  -->

<!-- <div class="service-container"> -->
<!-- <div class=" col-md-12"> -->
	<a  href="{{ route('home.pickup.info') }}" class="myservice red" >

	<div class="service-icon">
	<img class="img-circle" width="140" height="140" alt="Generic placeholder image" src="{{url()}}/images/home/noodle_pickup.png">
	</div>
	<div class="service-text">
	<h2>{{ trans('front_home.pick_up') }}</h2>
	<p>{{ trans('front_home.pick_up_ext') }}</p>
	</div>
</a>
<!-- </div> -->


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

@if($shop->popup)
	@section('scripts.footer')
	 <script type="text/javascript"> 
	 swal({   
	 	title:"",
	// // 	text: " $adv['text'] ",
		text: {!! json_encode($shop->popuptext) !!},
	//  	text: "We are close on Wednesday and thursday and Tuesday(25th, 26th).",
	// // 	imageUrl: "images/home/voucher_adv.jpg",
	// // 	imageSize:"200x200",
		showConfirmButton: true,
		confirmButtonColor: '#e41837',
	 	});
	 </script>
	@endsection
@endif