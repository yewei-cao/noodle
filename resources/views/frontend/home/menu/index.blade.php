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
    	<a href="{{ route('menu.index') }}"  class="btn redbtn  {{$active['menu']}}">Menu</a>
	</div>
</div>
  
<div class="btn-group btn-group-justified top10" role="group" >
	<div class="btn-group nav_lowmenu" role="group">
    	<a href="/menu/noodles"  class="btn redbtn  {{$active['noodles']}}">Noodles</a>
	</div>
	<div class="btn-group nav_lowmenu" role="group">
    	<a href="/menu/rice" class="btn redbtn  {{$active['rice']}}">Rice</a>
	</div>
  <div class="btn-group nav_lowmenu" role="group">
    <a href="/menu/snack&drinks" class="btn redbtn  {{$active['snack&drinks']}}">Snack&drinks</a>
  </div>
</div>

<div class="btn-group btn-group-justified top10" role="group" >
  <div class="btn-group nav_lowmenu" role="group">
    <a href="/menu/soups"  class="btn redbtn  {{$active['soups']}}">Soups</a>
  </div>
  <div class="btn-group nav_lowmenu" role="group">
    <a href="/menu/chips" class="btn redbtn {{$active['chips']}}">Chips</a>
  </div>
</div>
<!-- end top bar -->

<div class="main-container">
	<div class="row order-body">
		@foreach($catalogues as $catalogue)
			<div class="col-md-12 float-left">
				<h2>{{ $catalogue->name }}</h2>
				<hr/>
				
				@foreach($catalogue->menudishes() as $dish)
	            <div class="product-container" >
	                <div class="product" >
		                <div class="pheader">
		                	<div class="content_num"><span class="content_num_span">{{ $dish->number }}</span></div>
		                 	<div class="name-container"><span><a href="{{ action('Frontend\Home\HomeController@dish',[str_slug($dish->name)]) }}">{{ $dish->name }}</a></span></div>
	                 	</div>
	                 	
		                   <a href="{{ action('Frontend\Home\HomeController@dish',[str_slug($dish->name)]) }}">
								<img src="/{{ $dish->photo_thumbnail_path }}" alt="">
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
			</div>
		@endforeach	
    
	</div><!-- /.row -->
</div><!-- /.main-container -->

@endsection
@section('scripts.footer')
<script src="/js/mymenu.js"></script>
@endsection