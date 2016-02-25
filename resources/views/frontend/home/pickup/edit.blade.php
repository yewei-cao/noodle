@extends('frontend.master')

@section('content')


<div id="detail-container">

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
