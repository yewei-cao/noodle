@extends('frontend.home.menu_master')

@section('order-layout')

<div class="order-layout-left" style="min-height: 588px;" >

	<div id="product_menu_container" class="order-layout-left-inner">

		<div class="payment_confirm" >
			<h3 class="header lighter smaller text-center">{{ trans('front_home.credit_title') }}</h3>
			
			
			<div class="payment_content">
			
			<div class="disclaimer">
				<div class="payment_method_container">
				
					<div class="confirm-message cash" id="confirm-message">
						<p >Amount:<span class="red_text">${{ $totalprice }}</span></p>
						
						{!! Form::open(['method'=>'POST','action'=>'Frontend\Home\paymentcontroller@credittaken'])!!}
						  <script
						    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
						    data-key="{{ env('STRIPE_PUBLIC')}}"
						    data-amount="{{ $totalprice*100 }}"
						    data-name="Payment"
						    data-description="Credit Card"
						    data-image="/img/documentation/checkout/marketplace.png"
						    data-locale="auto"
						    data-currency="NZD">
						  </script>
						{!! Form::close() !!}
    				</div>
				
					<h4><a href="{{ route('home.payment.cash') }}">Pay by Cash</a>
					</h4>
				</div>
			
			</div>
			
			<div class="order-details">
				<h4 class="red_text">{{ trans('front_home.selecttime') }}</h3>
				<p>{{ $time }}</p>
				
				
				<h4 class="red_text">{{ trans('front_home.storedetail') }}</h3>
				 <div class="basket_row">
					<div id="selected-service-method">
		   				<div>Taradale Store</div>
		    			<div>06 844 3588</div>
		   				<div>Shop 8 &amp; 269 Gloucester Street </div>
		   				<div>Taradale</div>
		    			<div>Napier, NZ</div>    
					</div>        
				</div>
			
			</div>
			
			</div>
			
			
			<div class="row">
                 <a class="btn next medium btn-lg " href="http://noodle.app/home/payment/paymentmethod">
                	{{ trans('front_home.place_order') }}
                 </a>
            </div>
			
			
		</div>
	
	</div>
	
</div>

@endsection