@extends('frontend.home.menu_master')

@section('order-layout')

<div class="order-layout-left" >

	<div id="product_menu_container" class="order-layout-left-inner">

	@foreach($catalogues as $catalogue)
			<div class="col-md-12 float-left">
				<h2>{{ $catalogue->name }}</h2>
				<hr/>
				
				@foreach($catalogue->menudishes() as $dish)
				
	            <div class="product-container" >
	                <div class="product" >
	                    <img src="/{{ $dish->photo_thumbnail_path }}" alt="">
	                    <div class="caption">
	                        <div class="name-container"><span>{{ $dish->name }}</span></div>
	                        
	                        <div class="pricing-row">
	                        <span>From</span>
	                        <em class="dollar">$</em>
	                        <span class="price">{{ number_format($dish->price,2) }}</span>
	                        
	                        </div>
	                        <div class="description-row">
	                        <span class="description">{{ $dish->description }}</span>
	                        </div>
	                        
	                        <div class="form-container input-group">
	                        
	                        	<div class="col-md-12">
	                        		<div class="add-to-basket">
	                        			<button class="btn redbtn add-to-order" item-code="{{ $dish->number }}">Buy Now!</button> 
	                        		</div>
	                        	
	                        	</div>
	                        
	                        </div>
	                        
	                    </div>
	                </div>
	            </div>
	            
	            @endforeach	
	            
			</div>
			
	@endforeach	
	
		</div><!-- col-md-9 -->
		
		</div>

@endsection