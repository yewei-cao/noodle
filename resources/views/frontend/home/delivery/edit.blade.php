@extends('frontend.primary')

@section('content')

<div class="detail-container">
	<div class="yellowbtn btn-lg longbutton text-center" >
		{{ trans('front_home.delivery_text') }}
	</div>
</div>

<div class="detail-container">

{!! Form::model($delivery,['method'=>'GET','action'=>['Frontend\Home\Delivery\deliveryController@delivery_details'],'id'=>'myform','data-toggle'=>'validator'])!!}

	@include('frontend.home.delivery.form')

{!! Form::close() !!}

</div>

@endsection

@section('scripts.footer')
<script src="/js/validate.js"></script>

@endsection
