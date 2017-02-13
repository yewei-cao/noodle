@extends('frontend.home.menu_master')

@section('order-layout')

<div class="order-layout-left" >

{!! Form::open(['method'=>'POST','action'=>['Frontend\Home\menuController@search'],'class'=>'row'])!!}
	<div id="custom-search-input">
    	<div class="input-group col-md-12">
    		{!! Form::text('search', $search,['class'=>'form-control input-lg','placeholder'=>'search for a meal']) !!}
	        <span class="input-group-btn">
            	<button class="btn btn-info btn-lg" type="submit" >
                	<i class="glyphicon glyphicon-search"></i>
                </button>
            </span>
        </div>
	</div>
 {!! Form::close() !!}
 
	<div id="product_menu_container" class="order-layout-left-inner">

		<div class="col-md-12 float-left">
			
			@if($dishes->count())
			@foreach($dishes as $dish)
			
            <div class="product-container" >
                <div class="product" >
	                <div class="pheader">
	                	<div class="content_num"><span class="content_num_span">{{ $dish->number }}</span></div>
	                 	<div class="name-container"><span><a href="{{ action('Frontend\Home\menuController@dish',[str_slug($dish->name)]) }}">{{ $dish->name }}</a></span></div>
                 	</div>
	                   <a href="{{ action('Frontend\Home\menuController@dish',[str_slug($dish->name)]) }}">
							<img src="/{{ $dish->photo_thumbnail_path }}" alt="{{ $dish->name }}">
	                   </a>
                    <div class="caption">
                       
                        
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
                        			<a class="btn redbtn" href="{{ action('Frontend\Home\menuController@dish',[str_slug($dish->name)]) }}">Add to Order</a> 
                        		</div>
                        	
                        	</div>
                        
                        </div>
                        
                    </div>
                </div>
            </div>
            
            @endforeach
            
            @else
            
	            <div style="height: 600px;">
	            <h2>No Results</h2>
	            </div>
            @endif
            	
            
		</div>
			
	
	</div><!-- col-md-9 -->
</div>
@endsection