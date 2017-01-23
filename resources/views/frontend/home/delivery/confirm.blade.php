@extends('frontend.primary')

@section('title')
{{ trans('front_title.deliveryresult').trans('front_title.title') }}
@endsection

@section('css.style')
<style>

</style>
@endsection

@section('content')

<div class="detail-container row-bordered text-center"> 
	<h1 id="page_title">{{ trans('front_home.delivery_confirm') }}</h1>
</div>

{!! Form::open(['method'=>'GET','action'=>['Frontend\Home\Delivery\deliveryController@saveordertime'],'id'=>'myform','data-toggle'=>'validator'])!!}

	<div class="detail-container">

		<div class="starter text-center">
			<h2>{{ trans('front_home.address_confirm_title') }} {{ $address }}</h2>
			<h2>{{ trans('front_home.address_deliveryfee') }} ${{ $deliveryfee }}</h2>
			
<!-- 			<h4>{{ trans('front_home.address_freedilivery') }}</h4> -->
			<h4>{{ trans('front_home.address_confirm') }}</h4>
			
		</div>
	
	</div>
	
	<div class="form-group">
		<div class="detail-container pager">
			<div class="aspn redbtn btn-lg" >
				<a class="no_dec"  href="{{ route('home.delivery.address')}}" >
						{{ $address }}
				</a>
			</div>
		</div>
	</div>
	
	<div class="form-group">
		<div class="detail-container pager">
			<div class="previousbtn btn-lg longbutton text-center" >
				<a href="{{ URL::previous() }}" >
						{{ trans('front_home.previous') }}
				</a>
			</div>
		</div>
	</div>
	
{!! Form::close() !!}

	
@endsection

@section('scripts.footer')
<script src="/js/validate.js"></script>

<script type="text/javascript">

(function($) {

}(jQuery));

</script>

@endsection
