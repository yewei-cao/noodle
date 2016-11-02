@extends('frontend.primary')

@section('css.style')

<style>


</style>

@endsection

@section('content')


<div id="detail-container">

{!! Form::open(['method'=>'GET','action'=>['Frontend\Home\Delivery\deliveryController@delivery_details'],'id'=>'myform','data-toggle'=>'validator'])!!}

	@include('frontend.home.delivery.form')

{!! Form::close() !!}

</div>

@endsection


@section('scripts.footer')
<script src="/js/validate.js"></script>

<script type="text/javascript">

(function($) {

}(jQuery));

</script>

@endsection
