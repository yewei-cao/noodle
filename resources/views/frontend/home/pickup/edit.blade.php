@extends('frontend.primary')

@section('title')
{{ trans('front_title.pickupdetails').trans('front_title.title') }}
@endsection

@section('meta')
	{!! $shop->meta !!}
@endsection

@section('content')

<div class="detail-container row-bordered text-center"> 
	<h1 id="page_title">{{ trans('front_home.pickup') }}</h1>
</div>

<div class="detail-container">
{!! Form::model($pickup,['method'=>'GET','action'=>['Frontend\Home\Pickup\pickupController@pickup_details'],'id'=>'myform','data-toggle'=>'validator'])!!}
	@include('frontend.home.pickup.form')
{!! Form::close() !!}
</div>

@endsection

@section('scripts.footer')
<script src="/js/validate.js"></script>

<script type="text/javascript">
</script>

@endsection
