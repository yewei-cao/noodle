@extends('frontend.primary')

@section('css.style')
<style>

</style>
@endsection

@section('content')

<div id="detail-container">

{!! Form::open(['method'=>'GET','action'=>['Frontend\Home\Delivery\deliveryController@saveordertime'],'id'=>'myform','data-toggle'=>'validator'])!!}

	<div class="starter text-center">
		<h2>{{ trans('front_home.address_confirm_title') }} {{ $address }}</h2>
		<h4>{{ trans('front_home.address_confirm') }}</h4>
		
		<a class="no_dec"  href="{{ route('home.delivery.address')}}">
		<div class=" aspn redbtn btn-lg">
		{{ $address }}
		</div>
		</a>
		
		<div class="form-group">
		<!-- Previous/Next buttons -->
		  <ul class="pager wizard">
		  	<li class="previous"><a href="{{ url('home/delivery') }}">{{ trans('front_home.previous') }}</a></li>
		  	
		  </ul>
		</div>
	
		{!! Form::close() !!}

	</div>

</div>

@endsection

@section('scripts.footer')
<script src="/js/validate.js"></script>

<script type="text/javascript">

(function($) {

}(jQuery));

</script>

@endsection
