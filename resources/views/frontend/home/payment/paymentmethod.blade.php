@extends('frontend.home.menu_master')

@section('title')
{{ trans('front_title.paymentmethod').trans('front_title.title') }}
@endsection

@section('order-layout')

<div class="order-layout-left" style="min-height: 588px;" >

	<div id="product_menu_container" class="order-layout-left-inner">

	
		<div class="col-sm-12" >
			<h3 class="header lighter smaller text-center">{{ trans('front_home.payment_text') }}</h3>
			
			<ul class="horizon-list">
			
			@if($pickupmark)
				<li>
					<a class="btn-yellow btn-primary btn-lg aspn" href="{{ route('home.payment.cash') }}"  type="button">
						{{ trans('front_home.paymentmethod.payinstore') }}
					</a>
				</li>
				
			@elseif($shop->cash)
				<li>
					<a class="btn-yellow btn-primary btn-lg aspn" href="{{ route('home.payment.cash') }}"  type="button">
					{{ trans('front_home.paymentmethod.cash') }}
					</a>
				</li>
				
			@endif
			
			
			@if($shop->poli)
			<li>
			<a class="btn-primary btn-lg" href="{{ route('home.payment.policonfirm') }}"  type="button">
			{{ trans('front_home.paymentmethod.poli') }}
			</a>
			</li>
			@endif
			
			@if($shop->credit)			
			<li>
			<a class="redbtn btn-lg aspn" href="{{ route('home.payment.credit') }}" type="button">
			{{ trans('front_home.paymentmethod.credit') }}
			</a>
			</li>
			@endif
			
			</ul>
			
		</div>
		
	</div>
	
</div>
        
@endsection