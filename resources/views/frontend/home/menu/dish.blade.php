@extends('frontend.primary')

@section('title')
{{ trans('front_title.menu').trans('front_title.title') }}
@endsection

@section('meta')
{!! $shop->meta !!}
<meta name="_token" content="{{ csrf_token() }}">
@endsection

@section('css.style')
<style type="text/css">
#wrap {
margin:0;
}
</style>
@endsection

@section('jscript')
<script src="/js/breakpoints.js"></script>
<script src="/js/sticky-kit.js"></script>
@endsection

@section('content')
<!--  top bar -->

<div class="btn-group btn-group-justified" role="group" >
	<div class="btn-group nav_lowmenu" role="group">
    	<a href="{{ route('home.menu.index') }}"  class="btn redbtn  {{$active['menu']}}">Menu</a>
	</div>
</div>
  
<div class="btn-group btn-group-justified top10" role="group" >
	<div class="btn-group nav_menu" role="group">
    	<a href="/home/menu/noodles"  class="btn redbtn  {{$active['noodles']}}">Noodles</a>
	</div>
	<div class="btn-group nav_menu" role="group">
    	<a href="/home/menu/rice" class="btn redbtn  {{$active['rice']}}">Rice</a>
	</div>
  <div class="btn-group nav_menu" role="group">
    <a href="/home/menu/snack&drinks" class="btn redbtn  {{$active['snack&drinks']}}">Snack&drinks</a>
  </div>
  
  <div class="btn-group nav_lowmenu" role="group">
    <a href="{{ route('home.payment.paymentmethod') }}" class="btn redbtn {{$active['payment']}}">Payment</a>
  </div>
</div>

<div class="btn-group btn-group-justified top10" role="group" >
  <div class="btn-group nav_lowmenu" role="group">
    <a href="/home/menu/soups"  class="btn redbtn  {{$active['soups']}}">Soups</a>
  </div>
  <div class="btn-group nav_lowmenu" role="group">
    <a href="/home/menu/chips" class="btn redbtn {{$active['chips']}}">Chips</a>
  </div>
</div>
<!-- end top bar -->

<div class="main-container">

	<div id="product_menu_container" class="order-layout-left-inner">
		<form name="adddish_item" method="POST" action="{{ route('home.dish.adddish') }}">
		<input type="hidden" value="" name="takeout">
		<input type="hidden" value="" name="extra">
		<input type="hidden" value="{{$dish->number}}" name="dish_num">
		
		<div class="col-md-12 float-left top10">
			
				<div class="col-md-4 float-left">
                	<div class="dish_num top15"><span class="content_num_span">{{ $dish->number }}</span></div>
                </div>
                
                <div class="col-md-6 float-left">
                	<div class="dish_title"><h3>{{ $dish->name }}</h3></div>
                </div>
                
                <div class="col-md-2 float-left">
                	<h3 class=" text-right" >$<span id="dish_price">{{ $dish->price }}</span></h3>
                </div>
			
		</div>
		
		<div class="col-md-12 float-left">
			
			<div class="col-md-6 float-left">
			
				<img alt="{{$dish->name }}" src="/{{$dish->photo_path}}">
		
			</div>
			
			<div class="col-md-6 float-left">
				<h4>Description</h4>
				
				<div class="description">
	               {{$dish->description}}
	            </div>
	            
	            @if($materials)
	            	
	            <h4>Flavour</h4>
	            <select  name="flavour">
				  <option>Normal</option>
				  <option>Mild</option>
				  <option>Medium</option>
				  <option>Hot</option>
				</select>
	            
				<h4>Dish Materials</h4>
				
				<div class="material-container">
					<div class="material-message">
			            <h4 class="current-material-text">Current Dish Materials</h4>
			            <span  class="remove-material-text" >(Click to remove)</span>
			        </div>
			        
			        <div class="current-material-container">
			        	<ul class="current-material" >
			        		@foreach($materials as $material)
				        		<li>
				        			<div class="material_edit">
				        				<button type="button" class="btn choicebtn material_rm" item-code="{{ $material['id'] }}">{{ $material['name'] }}</button>
				        				
<!-- 				        				<a class="remove-topping btn-quantity btn-quantity-0" > -->
<!--                                 		</a> -->
				        			</div>
				        		</li>
			        		@endforeach
			        	</ul>
			        </div>
					
				</div>
				@endif
					
				<div class="input-group quantity">
					
	                	<div class="form-group">
							<div class="col-md-12 top10">
								<a class="btn redbtn add-to-order longbutton" href="/home">Place an Order</a>
	                 		</div>
	                 	
	                 	</div>
				</div>
			</div>
		</div>
		
		{{ csrf_field() }}
		</form>	
	</div><!-- col-md-9 -->
		
</div>

@endsection
