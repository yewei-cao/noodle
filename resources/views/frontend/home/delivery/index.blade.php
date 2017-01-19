@extends('frontend.primary')

@section('title')
{{ trans('front_title.deliverydetails').trans('front_title.title') }}
@endsection

@section('css.style')
@endsection

@section('content')

<div class="detail-container row-bordered text-center"> 
	<h1 id="page_title">{{ trans('front_home.delivery_text') }}</h1>
</div>

<div class="detail-container">
{!! Form::open(['method'=>'GET','action'=>['Frontend\Home\Delivery\deliveryController@delivery_details'],'id'=>'myform','data-toggle'=>'validator'])!!}
	@include('frontend.home.delivery.form')
{!! Form::close() !!}
</div>

@endsection

@section('scripts.footer')
<script src="/js/validate.js"></script>
@endsection
