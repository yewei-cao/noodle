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

@yield('dish_list')

@endsection
@section('scripts.footer')
<script src="/js/mymenu.js"></script>
@endsection