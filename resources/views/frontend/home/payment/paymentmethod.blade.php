@extends('frontend.home.menu_master')

@section('order-layout')

<div class="order-layout-left" style="min-height: 588px;" >

	<div id="product_menu_container" class="order-layout-left-inner">

	
		<div class="col-sm-12" >
			<h3 class="header lighter smaller text-center">{{ trans('front_home.payment_text') }}</h3>
			
			<ul class="horizon-list">
			<li>
			<a class="btn-yellow btn-primary btn-lg aspn" href="{{ route('home.payment.cash') }}" id="asap" type="button">
			{{ trans('front_home.paymentmethod.cash') }}
			</a>
			</li>
			
			<li>
			<a class="redbtn btn-lg aspn" href="{{ route('home.payment.credit') }}" id="asap" type="button">
			{{ trans('front_home.paymentmethod.credit') }}
			</a>
			</li>
			
			</ul>
			
		</div>
		
	</div>
	
</div>
        
@endsection