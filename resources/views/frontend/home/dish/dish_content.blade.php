@extends('frontend.home.menu_master')

@section('title')
{{ $dish->name }} - {{ trans('front_title.menu') }}
@endsection

@section('order-layout')

<div class="order-layout-left" >

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
					<label id="at-quantity-label" for="at-quantity">QTY</label>
					
	                	<div class="form-group">
							<div class="col-md-12">
							
								<div class="input-group">
							          <span class="input-group-btn">
							              <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="num">
							                <span class="glyphicon glyphicon-minus"></span>
							              </button>
							          </span>
							          <input type="text" name="num" class="form-control input-number" value="1" min="1" max="100">
							          <span class="input-group-btn">
							              <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="num">
							                  <span class="glyphicon glyphicon-plus"></span>
							              </button>
							          </span>
							     </div>
						      	
							</div>
						
							<div class="col-md-12 top10">
	                 			<button class="btn redbtn add-to-order longbutton" type="submit" >Add to Order</button>
	                 		</div>
	                 	
	                 	</div>
	                 	
				</div>
				
			</div>
            
		</div>
		
		@if($materials)
		<div class="col-md-12 float-left">
			<h4>Extra Vegetable in Meal</h4>
			<span  class="remove-material-text" >(Click to Add)</span>
			<hr/>
			
		  	<div class="current-material-container">
        		<ul class="current-material" >
        		@foreach($veges->material as $material)
	        		<li>
	        			<div class="material_edit">
	        				<button type="button" class="btn unchoicebtn material_ad" price="{{ $material->price }}" item-code="{{ $material->id }}">{{ $material->name }} ${{$material->price }}</button>
	        			</div>
	        		</li>
        		@endforeach
        		</ul>
		   	</div>
		   	
		   	<h4>Extra Meat in Meal</h4>
		   	<span  class="remove-material-text" >(Click to Add)</span>
			<hr/>
			
		  	<div class="current-material-container">
        		<ul class="current-material" >
        		@foreach($meat->material as $material)
	        		<li>
	        			<div class="material_edit">
	        				<button type="button" class="btn unchoicebtn material_ad" price="{{ $material->price }}" item-code="{{ $material->id }}">
	        				{{ $material->name }}
	        				${{$material->price }}
	        				</button>
	        			</div>
	        		</li>
        		@endforeach
        		</ul>
		   	</div>
		</div>
		@endif
		
		{{ csrf_field() }}
		</form>	
	</div><!-- col-md-9 -->
		
</div>

@endsection
