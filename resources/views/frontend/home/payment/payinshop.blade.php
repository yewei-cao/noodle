@extends('frontend.home.menu_master')

@section('title')
{{ trans('front_title.cash').trans('front_title.title') }}
@endsection

@section('order-layout')

<div class="order-layout-left" style="min-height: 588px;" >

	<div id="product_menu_container" class="order-layout-left-inner">

		<div class="payment_confirm" >
			<h3 class="header lighter smaller text-center">{{ trans('front_home.cash_title') }}</h3>
			
			
			<div class="payment_content">
			
			<div class="disclaimer">
				<div class="payment_method_container">
				
					<div class="confirm-message cash" id="confirm-message">
        				<p class="red_text"><strong>Please Note:</strong></p>
        				<p class="copy">By clicking the Place Order button below, you are confirming your order for 
        				<span class="red_text">${{ $totalprice }}</span>. Your IP address of 
        				<span class="red_text">{{ $ip }}</span> will be logged when your order is placed.</p>
        				<p class="copy">Your order will begin processing as soon as you click Place Order.You may receive a phone call to confirm your order.If you are unavailable, then your order may be cancelled.</p>
    				</div>
				
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
		   				<div>269 Gloucester Street </div>
		   				<div>Taradale</div>
		    			<div>Napier, NZ</div>    
					</div>        
				</div>
			
			</div>
			
			</div>
			
			<div class="row">
				{!! Form::open(['method'=>'POST','action'=>'Frontend\Home\Payment\paymentcontroller@placeorder','id'=>'pay_submit'])!!}
	                {!! Form::label('message','Message:') !!}
	                {!! Form::textarea('message', null,['size' => '30x5','class'=>'form-control']) !!} 
	                <hr>
	                <button type="submit" class="redbtn next btn-lg aspn " id="submit_order">{{ trans('front_home.place_order') }}</button>
	            {!! Form::close() !!}
            </div>
			
		</div>
	
	</div>
	
</div>

@endsection 
