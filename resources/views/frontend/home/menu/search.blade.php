@extends('frontend.home.menu.menu_master')

@section('dish_list')

{!! Form::open(['method'=>'POST','action'=>['Frontend\Home\HomeController@search'],'class'=>'row'])!!}
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
 
<div class="main-container">
	<div class="row order-body">
			
			@if($dishes->count())
			@foreach($dishes as $dish)
            <div class="product-container" >
                <div class="product" >
	                <div class="pheader">
	                	<div class="content_num"><span class="content_num_span">{{ $dish->number }}</span></div>
	                 	<div class="name-container"><span><a href="{{ action('Frontend\Home\HomeController@dish',[str_slug($dish->name)]) }}">{{ $dish->name }}</a></span></div>
                 	</div>
                 	
	                   <a href="{{ action('Frontend\Home\HomeController@dish',[str_slug($dish->name)]) }}">
							<img alt="{{$dish->name }}" src="/{{ $dish->photo_thumbnail_path }}">
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
                        
                    </div>
                    
                </div>
            </div>
           @endforeach
           
           @else
            
	            <h2>No Results</h2>
            @endif
    
	</div><!-- /.row -->
</div><!-- /.main-container -->

@endsection