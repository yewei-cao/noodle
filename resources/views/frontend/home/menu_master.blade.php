@extends('frontend.primary')

@section('title')
{{ trans('front_title.menu').trans('front_title.title') }}
@endsection

@section('meta')
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
  
  <div class="btn-group nav_lowmenu" role="group">
    <a href="/home/menu/snack&drinks"  class="btn redbtn  {{$active['snack&drinks']}}">Snack&drinks</a>
  </div>
</div>
<!-- end top bar -->

<div class="basket-shadow"></div>

<div class="main-container">

	<div class="row order-body">
	
		<div class="content order-layout" id="order_main">
			@yield('order-layout')
	
			@include('frontend.includes.order_details')

    	</div><!-- /.content -->
    
	</div><!-- /.row -->

</div><!-- /.main-container -->

<div class="fixed-footer hide-for-small-up">
    <div class="row">
        <div class="col-6">
            <a class="btn next" id="place_order_fixed" href="{{route('home.payment.paymentmethod')}}">
                <span >Place Order</span>
            </a>
        </div>
        <div class="col-6">
            <a class="btn open-basket" id="open-basket">
                <span class="number-of-items">{{ $totalnumber }}</span>
                <span class="total-text">Total</span>
                <span class="total ">${{ $totalprice }}</span>
            </a>
        </div>
    </div>
</div>

@endsection

@section('scripts.footer')
<script src="/js/mymenu.js"></script>
@endsection