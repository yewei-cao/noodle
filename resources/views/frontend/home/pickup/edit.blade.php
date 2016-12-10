@extends('frontend.primary')

@section('content')

<div class="detail-container">
	<div class="yellowbtn btn-lg longbutton text-center" >
		{{ trans('front_home.pickup') }}
	</div>
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
